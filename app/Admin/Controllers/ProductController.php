<?php

namespace App\Admin\Controllers;

use App\Product;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Helpers\FormatHelper;

class ProductController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Produtos';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Product);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Nome'));
        $grid->column('description', __('Descrição'));
        $grid->column('price', __('Valor'))->display(function() {
            return FormatHelper::formatMoney($this->price);
        });
        $grid->column('image_url', __('Imagem'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Product::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Nome'));
        $show->field('description', __('Descrição'));
        $show->field('price', __('Preço'))->as(function() {
            return FormatHelper::formatMoney($this->price);
        });
        $show->field('image_url', __('Imagem'));
        $show->field('created_at', __('Criado'))->as(function() {
            return FormatHelper::formatDate($this->created_at);
        });
        $show->field('updated_at', __('Atualizado'))->as(function() {
            return FormatHelper::formatDate($this->updated_at);
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Product);

        $form->text('name', __('Nome'))->rules("required|string|min:5");
        $form->text('description', __('Descrição'))->rules("required|string|min:5");
        $form->currency('price', __('Preço'))->symbol("R$")->default(0.00)->rules("required|numeric|min:1");;
        $form->text('image_url', __('Imagem'))->rules("nullable");;

        return $form;
    }
}
