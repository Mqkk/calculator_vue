<?php

namespace App\Admin\Controllers;

use App\Models\ExtraWork\ExtraWork;
use App\Models\Material\Material;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ExtraWorkController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Дополнительные работы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new ExtraWork());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('name', __('Наименование'))->sortable();
        $grid->column('cost', __('Цена'))->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(ExtraWork::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Наименование'));
        $show->field('cost', __('Цена'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new ExtraWork());

        $form->display('id', __('ID'));
        $form->text('name', __('Наименование'));
        $form->text('cost', __('Цена'));

        return $form;
    }
}
