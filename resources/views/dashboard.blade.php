@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $medecins }}</h3>
                <p>Médecins</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-md"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $specialites }}</h3>
                <p>Spécialités</p>
            </div>
            <div class="icon">
                <i class="fas fa-tags"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $creneaux }}</h3>
                <p>Créneaux</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-2 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $patients }}</h3>
                <p>Patients</p>
            </div>
            <div class="icon">
                <i class="fas fa-user"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $rendezvous }}</h3>
                <p>Rendez-vous</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

</div>
@endsection
