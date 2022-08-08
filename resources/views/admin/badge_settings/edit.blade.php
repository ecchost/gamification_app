@extends('layouts.app')
@section('title')
    Edit Badge Setting
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading m-0">Edit Badge Setting</h3>
            <div class="filter-container section-header-breadcrumb row justify-content-md-end">
                <a href="{{ route('admin.badgeSettings.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="content">
            @include('stisla-templates::common.errors')
            <div class="section-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body ">
                                {!! Form::model($badgeSetting, ['route' => ['admin.badgeSettings.update', $badgeSetting->id], 'method' => 'patch', 'enctype' => 'multipart/form-data']) !!}
                                <div class="row">
                                    @include('admin.badge_settings.fields')
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
