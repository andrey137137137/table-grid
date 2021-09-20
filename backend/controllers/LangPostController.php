<?php

namespace backend\controllers;

/**
 * LangPostController implements the CRUD actions for LangPost model.
 */
class LangPostController extends AppController
{
  protected $modelClass = 'LangPost';
  protected $helperModels = ['Post' => 'url'];
}
