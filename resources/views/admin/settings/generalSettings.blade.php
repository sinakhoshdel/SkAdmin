<div class="tab-pane fade active show" id="general-settings" role="tabpanel" aria-labelledby="general-settings-tab">
    <form action="{{url('admin/saveGeneralSettings')}}" method="post">
        {{csrf_field()}}
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="site_name">Site Name</label>
                <input id="site_name" type="text" class="form-control form-control-sm" name="site_name" value="{{$generalSetting->site_name}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="site_email">Contact Form Email Address</label>
                <small>This email will send and receive all messages from contact form. </small>
                <input id="site_email" type="text" class="form-control form-control-sm" name="site_email" value="{{$generalSetting->site_email}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="site_tags">Tags(optional)</label>
                <input id="site_tags" type="text" class="form-control form-control-sm" data-role="tagsinput" name="site_tags" value="{{$generalSetting->site_tags}}">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="site_description">Short Description (optional)</label>
                <textarea id="site_description" name="site_description" class="form-control form-control-sm" maxlength="7000">{{$generalSetting->site_description}}</textarea>
            </div>
        </div>
        <div class="form-row">
            <div class="input-group col-md-4 mt-2 mb-3">
                <span class="input-group-btn">
                    <a id="lfm" data-input="site_logo" data-preview="site_logo" class="btn btn-sm btn-block btn-primary">
                      <i class="fa fa-picture-o"></i> Site Logo
                    </a>
                </span>
                <input id="site_logo" class="form-control form-control-sm" type="text" name="site_logo" style="border-radius: 0 5px 5px 0" value="{{$generalSetting->site_logo}}">
                {{--<img class="mt-2 img-fluid" id="site_logo" src="{{url($generalSetting->site_logo)}}">--}}
            </div>
            <div class="input-group col-md-4 mt-2 mb-3">
                <span class="input-group-btn">
                    <a id="lfm1" data-input="admin_logo" data-preview="admin_logo" class="btn btn-sm btn-block btn-primary">
                      <i class="fa fa-picture-o"></i> Admin Logo
                    </a>
                </span>
                <input id="admin_logo" class="form-control form-control-sm" type="text" name="admin_logo" style="border-radius: 0 5px 5px 0" value="{{$generalSetting->admin_logo}}">
                {{--<img class="mt-2 img-fluid" id="admin_logo" src="{{url($generalSetting->admin_logo)}}">--}}
            </div>
            <div class="col-md-4 mt-2 mb-3">
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="lfm2" data-input="fav_icon" data-preview="fav_icon" class="btn btn-sm btn-block btn-primary">
                          <i class="fa fa-picture-o"></i> fav Icon
                        </a>
                    </span>
                    <input id="fav_icon" class="form-control form-control-sm" type="text" name="fav_icon" style="border-radius: 0 5px 5px 0" value="{{$generalSetting->fav_icon}}">
                    {{--<img class="mt-2 img-fluid" id="admin_logo" src="{{url($generalSetting->fav_icon)}}">--}}
                </div>
            </div>
        </div>
        <button type="submit" class="text-right btn btn-success">Save</button>
    </form>
</div>