@extends('admin.layouts.app')

@section('content')
    @php
        $root = \App\User::descendantsAndSelf($user->id)->toTree();
    @endphp
    <section class="content-header">
        @include('admin.users.partials.nav')
    </section>


    <!-- Main content -->
    <section class="content" style="overflow: auto">

        <p>Tổng thành viên nhánh: {{ $user->descendants()->select(['id'])->count() }}</p>

        <div id="slimScrollDiv" class="clearfix" style="width: 5000px">
            <?php

            $traverse = function ($root, $prefix = '-') use (&$traverse) {
            echo '<ul class="clearfix">';
            foreach ($root as $user) {
            if( $user ){
            $color = '#e5e5e5';
            if( $user->status && $user->branch != 'root' )
                $color = $user->getCurrentPackage()->package->package_color;
            else{
                if( $registeredPackage = $user->getRegisteredPackage() ){
                    $color = $registeredPackage->package->package_color;
                }
            }
            ?>
            <li>
                <a style="background-color: {{ $color }}" href="">
                    <figure>
                        @if( !$user->avatar )
                            <img src="{{ url('client/images/faces-clipart/pic-3.png') }}" alt="{{ $user->full_name }}">
                        @else
                            <img src="{{ url($user->avatar) }}" alt="image">
                        @endif
                    </figure>

                    <p class="mb-0">
                        @if( $user->status )
                            <span class="btn  btn-success status btn-sm">
                    <i class="fa fa-check text-success"></i>
                </span>
                        @else
                            <span class="btn btn-danger status btn-sm">
                    <i class="fa fa-remove text-danger"></i>
                </span>
                        @endif
                        ID: {{ $user->id }}, {!! $user->getLevel() !!} <br>
                        {{ $user->user_name }}
                        @if( $user->parent )
                            <br>ID bảo trợ: {{ $user->user_reference }}
                        @endif
                    </p>
                </a>
                @if( count($user->children) )
                    @php $traverse( $user->children , $prefix.'-'); @endphp
                @endif
            </li>
            <?php

            }
            }
            echo '</ul>';

            };

            echo '<div class="tree-users">';
            $traverse($root);
            echo '</div>';

            ?>
        </div>

    </section>
    <!-- /.content -->


@stop

