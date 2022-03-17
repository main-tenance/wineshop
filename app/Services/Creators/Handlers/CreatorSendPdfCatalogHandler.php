<?php

namespace App\Services\Creators\Handlers;

use App\Mail\CreatorPdfCatalogMail;
use App\Models\Creator;
use App\Models\User;
use App\Services\Creators\Repositories\CreatorsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class CreatorSendPdfCatalogHandler
{
    private function getCreatorRepository()
    {
        return app(CreatorsRepository::class);
    }

    public function handle(User $user, Creator $creator): void
    {
        $wines = $this->getCreatorRepository()->getWinesByCreator($creator);
        $data = ['creator' => $creator, 'wines' => $wines];
        $rawAttachment = $this->getPdfHtml($data);
        Mail::to($user)->send(new CreatorPdfCatalogMail($user, $creator, $rawAttachment));
    }

    public function getPdfHtml(array $data): string
    {
        $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4-L',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'fontDir' => array_merge($fontDirs, [
                resource_path('pdf-style.fonts'),
            ]),
            'fontdata' => $fontData + [
                    'frutiger' => [
                        'R' => 'monotype_corsiva.ttf',
                    ],
                    'raleway' => [
                        'R' => 'ralewayregular.ttf',
                        'I' => 'ralewayitalic.ttf',
                    ]
                ],
        ]);
        $stylesheet = Storage::get('public/pdf-style/style.css');
        $mpdf->WriteHTML($stylesheet, \Mpdf\HTMLParserMode::HEADER_CSS);

        foreach ($data['wines'] as $wine) {
            View::share([
                'creator' => $data['creator'],
                'wine' => $wine,
            ]);
            $mpdf->AddPage();
            $html = view('creators.pdf-catalog-page')->render();
            $mpdf->WriteHTML($html, \Mpdf\HTMLParserMode::HTML_BODY);
        }

        return $mpdf->Output(false, \Mpdf\Output\Destination::STRING_RETURN);
    }

}
