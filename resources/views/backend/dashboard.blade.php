@extends('backend.layouts.master')

@push('plugin-styles')
  {!! Html::style('/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') !!}
@endpush

@section('meta_title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')
{{-- @section('page_title_sub', 'Welcome to Dashboard') --}}

@push('plugin-scripts')
  {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
  {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
  {!! Html::script('/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') !!}
@endpush

@push('custom-scripts')
  {!! Html::script('/assets/js/dashboard.js') !!}
@endpush