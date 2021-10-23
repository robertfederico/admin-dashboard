@extends('layouts.app')

@section('content')
    <div class="vld-parent" style="z-index: 999999;">
        <spinner 
            :active.sync="isLoading" 
            :can-cancel="true" 
            :background-color="this.background" 
            :color="this.color"
            :is-full-page="fullPage">
        </spinner>
    </div>
    
    <div class="content-wrapper">
        <router-view></router-view>
    </div>
@endsection
