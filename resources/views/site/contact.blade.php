@extends('site.layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contact') }}</div>
                    <div class="card-body">
                        <p class="hint-text">We'd love to hear from you, please drop us a line if you've any query.</p>
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <form action="{{url('postContact')}}" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control" required="">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input name="phone" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <input name="email" type="email" class="form-control" required="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <textarea name="message" class="form-control" rows="5" required=""></textarea>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection