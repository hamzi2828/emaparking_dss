@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{__('Pricing Plans')}}</h1>
        </div>
        @include('admin.message')
        <div class="row">
            <div class="col-md-4 mb40">
                <div class="panel">
                    <div class="panel-title">{{__("Add Plan")}}</div>
                    <div class="panel-body">
                        <form action="{{route('space.admin.plan.create', ['0'])}}" method="post">
                            @csrf
                            @include('Space::admin/plan/form')
                            <div class="">
                                <button class="btn btn-primary" type="submit">{{__("Add new")}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="filter-div d-flex justify-content-between ">
                    <div class="col-left">
                        @if(!empty($rows))
                            <form method="post" action="#" class="filter-form filter-form-left d-flex justify-content-start">
                                {{csrf_field()}}
                                <select name="action" class="form-control">
                                    <option value="">{{__(" Bulk Action ")}}</option>
                                    <option value="delete">{{__(" Delete ")}}</option>
                                </select>
                                <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-left">

                    </div>
                </div>
                <div class="panel">
                    <div class="panel-title">{{__("All Plans")}}</div>
                    <div class="panel-body">
                        <form class="bravo-form-item">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="60px"><input type="checkbox" class="check-all"></th>
                                    <th>{{__("Name")}}</th>
                                    <th class="date">{{__("Date")}}</th>
                                    <th class="date"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(count($rows) > 0)
                                    @foreach ($rows as $row)
                                        <tr>
                                            <td><input type="checkbox" class="check-item" name="ids[]" value="{{$row->id}}"></td>
                                            <td class="title">
                                                <a href="{{route('space.admin.plan.edit',['id'=>$row->id])}}">{{$row->name}}</a>
                                            </td>
                                            <td>{{ display_date($row->updated_at)}}</td>
                                            <td><a class="btn btn-primary btn-sm" href="{{route('space.admin.plan.edit',['id'=>$row->id])}}"><i class="fa fa-edit"></i> {{__('Edit')}}</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">{{__("No data")}}</td>
                                    </tr>
                                @endif
                                </tbody>
                                {{--{{$rows->appends(request()->query())->links()}}--}}
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
