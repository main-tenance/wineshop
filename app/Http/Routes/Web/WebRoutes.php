<?php


namespace App\Http\Routes\Web;


abstract class WebRoutes
{
    public const MAIN_INDEX = 'main.index';
    public const SEARCH_POPUP = 'search.popup';
    public const ABOUT_INDEX = 'about.index';
    public const USER_CREATE = 'user.create';
    public const USER_CREATE_POPUP = 'user.create.popup';
    public const USER_STORE = 'user.store';
    public const LOGIN = 'login';
    public const LOGIN_POPUP = 'login.popup';
    public const LOGIN_STORE = 'login.store';
    public const USER_EDIT = 'user.edit';
    public const USER_UPDATE = 'user.update';
    public const CREATOR_INDEX = 'creator.index';
    public const CREATOR_SHOW = 'creator.show';
    public const CREATOR_SEND_PDF = 'creator.send.pdf';
    public const OFFER_SHOW = 'offer.show';
    public const REVIEW_INDEX = 'review.index';
    public const REVIEW_CREATE = 'review.create';
    public const REVIEW_STORE = 'review.store';
    public const REVIEW_SHOW = 'review.show';
    public const REVIEW_EDIT = 'review.edit';
    public const REVIEW_UPDATE = 'review.update';
    public const REVIEW_DESTROY = 'review.destroy';
    public const PASSPORT_INDEX = 'passport.index';
}
