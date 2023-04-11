<?php

namespace App\ValidacionesCrud;

trait validaciones{
    //Reglas de validaciones generales
    private $reglasValidacionesGenerales = [
        'required' => 'El campo :attribute es requerido',
        'max' => 'El campo :attribute no debe ser mayor a :max caracteres',
        'min' => 'El campo :attribute no debe ser menor a :min caracteres',
        'numeric' => 'El campo :attribute debe ser un numero',
        'unique' => 'El campo :attribute ya existe',
        'email' => 'El campo :attribute debe ser un correo electronico',
        'confirmed' => 'El campo :attribute no coincide con la confirmacion',
        'date' => 'El campo :attribute debe ser una fecha',
    ];

    //Reglas de validaciones para la tabla mascotas

    private $reglasValidacionesAgregarMascotas = [
        'nombre' => 'required|max:50',
        'raza' => 'required|max:50',
        'color' => 'required|max:50',
        'edad' => 'required|numeric',
    ];

    private $reglasValidacionesEditarMascotas = [
        'idEditar' => 'required|numeric',
        'nombreEditar' => 'required|max:50',
        'razaEditar' => 'required|max:50',
        'colorEditar' => 'required|max:50',
        'edadEditar' => 'required|numeric',
    ];
}