<?php

namespace backend\controllers;

/**
 * VacancieController implements the CRUD actions for Vacancie model.
 */
class VacancieController extends AppController
{
  protected $modelClass = 'Vacancie';
  protected $helperModels = ['VacancieRank', 'VesselType'];
}
