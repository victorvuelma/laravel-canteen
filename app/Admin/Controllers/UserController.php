<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Helpers\FormHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Usuários';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('ID'));
        $grid->column('name', __('Nome'));
        $grid->column('email', __('Email'));
        $grid->column('cash', __('Saldo'));
        $grid->column('cpf', __('CPF'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('Nome'));
        $show->field('email', __('Email'));
        $show->field('cash', __('Saldo'));
        $show->field('cpf', __('CPF'));
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
        $form = new Form(new User);
        
        $form->text('name', __('Nome'))->rules('required|string|min:5');
        $form->text('cpf', __('CPF'))->rules('required|cpf')->inputmask(['mask' => '999.999.999-99']);
        $form->email('email', __('Email'))->rules('required|email');
        $form->currency('cash', __('Saldo'))->symbol("R$")->default(0.00)->rules('required|numeric|min:1');
        $form->password('password', __('Senha'))->creationRules('required|confirmed|min:4')
                                            ->updateRules('nullable|confirmed|min:4');
        $form->password('password_confirmation', __('Confirme a Senha'))->creationRules('required|min:4')
                                                                    ->updateRules('nullable|min:4');

        $form->editing(function (Form $form) {
            $form->builder()->fields()->get(1)->disable();
        });

        $form->saving(function (Form $form) {
            if($form->password != $form->model()->password){
                $form->password = Hash::make($form->password);
            }
        });

        return $form;
    }
}
