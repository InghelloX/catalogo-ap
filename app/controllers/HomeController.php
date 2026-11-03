<?php

esto es un error de sintaxis intencional
/**
 * Página de bienvenida.
 */
class HomeController extends Controller
{
    public function index(): void
    {
        $this->soloInvitados()
        $this->render('home/index', ['titulo' => 'Bienvenido'], 'auth');
    }
}
