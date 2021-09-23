<?php

namespace backend\controllers;

/**
 * LangPageController implements the CRUD actions for LangPage model.
 */
class LangPageController extends AppController
{
  protected $modelClass = 'LangPage';
  protected $helperModels = ['Page' => 'url'];
}
