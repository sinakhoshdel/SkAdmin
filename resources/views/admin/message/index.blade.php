@extends('admin.sections.master')
@section('title','Messages')
@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="breadcrumb-holder">
                            <h1 class="main-title float-left"><i class="fa fa-envelope-o"></i> Message Manager</h1>
                            <ol class="breadcrumb float-right">
                                <li class="breadcrumb-item">Home</li>
                                <li class="breadcrumb-item active">Message Manager</li>
                            </ol>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-xs-6 col-md-8">
                                        <div class="input-group mb-2">
                                            {{--<div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <i class="fa fa-search"></i>
                                                </div>
                                            </div>
                                            <form action="{{url('admin/message/search')}}">
                                                <input type="text" name="search_message" class="form-control" placeholder="@if(isset($search_string)){{$search_string}}@else Search Message... @endif">
                                            </form>--}}
                                        </div>
                                    </div>
                                    <div class="col-xs-6 col-md-4 topButton text-right">
                                        <button onclick="location.reload()" type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target=".bulk_remove_form">
                                            <i class="fa fa-trash" aria-hidden="true"></i> Remove Item(s)
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body table-responsive">
                                <div class="col-md-12">
                                    @if ($messageText = Session::get('success'))
                                        <div class="alert alert-success alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $messageText }}</strong>
                                        </div>
                                    @endif

                                    @if ($messageText = Session::get('error'))
                                        <div class="alert alert-danger alert-block">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $messageText }}</strong>
                                        </div>
                                    @endif

                                    {{--Reply modal box--}}
                                    <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true"
                                         id="modal_reply_message">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{url('admin/message/ReplyMessage')}}" method="post">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="messageId" id="replyMessageId">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Reply Message</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span
                                                                    aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>To</label>
                                                                    <input readonly id="replyMessageTo" class="form-control" name="To" type="text" value=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Subject</label>
                                                                    <input readonly id="replyMessageSubject" class="form-control" name="subject" type="text" value=""/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Message</label>
                                                                    <textarea id="replyMessageText" class="form-control" name="message" rows="4"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Reply Message</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    {{--End of Reply Modal--}}
                                    <div class="box box-primary">
                                        <div class="box-body no-padding">
                                            <div class="table-responsive mailbox-messages">
                                                <table class="table table-hover" id="admin-messsage-table">
                                                    <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" class="custom-control-input" id="checkAll" >
                                                                <label class="custom-control-label" for="checkAll"></label>
                                                            </div>
                                                        </th>
                                                        <th>From</th>
                                                        <th>Subject</th>
                                                        <th>Actions</th>
                                                        <th>Time</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @if(count($allMessages)>0)
                                                        @foreach($allMessages as $message)
                                                        <tr class="@if($message->unread ===1) bg-unread @endif">
                                                            <td>
                                                                <div class="custom-control custom-checkbox">
                                                                    <input name="selected[]" value="{{$message->id}}" type="checkbox" class="custom-control-input" id="defaultChecked{{$message->id}}"  >
                                                                    <label class="custom-control-label" for="defaultChecked{{$message->id}}"></label>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="{{route('message.show',$message->id)}}">
                                                                    @if($message->unread ===1)
                                                                        <i class="fa fa-circle text-primary"></i>
                                                                    @endif
                                                                        <b>{{$message->first_name}} {{$message->last_name}}</b>
                                                                </a>
                                                            </td>
                                                            <td><b>{{$message->subject}}</b> - {!! substr($message->message, 0,50) !!} ...</td>
                                                            <td class="mailbox-attachment">
                                                                <div class="btn-group">
                                                                    <a title="Delete" type="button" data-id="{{$message->id}}" class="removeMessage btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>
                                                                    <a onclick="replyMessage('{{$message->id}}','{{$message->email}}','{{$message->subject}}')" title="Reply" type="button" class="btn btn-default btn-sm"><i class="fa fa-reply"></i></a>
                                                                    {{--<a href="" title="Attachment" type="button" class="btn btn-default btn-sm"><i class="fa fa-paperclip"></i></a>--}}
                                                                </div>
                                                            </td>
                                                            <td class="mailbox-date">{{$message->created_at->diffForHumans()}}</td>
                                                        </tr>
                                                        @endforeach
                                                    @else
                                                        <tr class="text-center">
                                                            <td colspan="6"><img class="img-fluid" src="{{url("files/shares/icons/no_data_found.png")}}" alt="No Record Found"></td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="box-footer no-padding">
                                            <div class="pull-right">
                                                {{$allMessages->appends(request()->input())->links()}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--modal for remove message--}}
                                <div class="modal fade" id="removeMessageItem">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body bg-white">
                                                <p>Are you sure that you want to permanently delete the selected item?</p>
                                                <input type="hidden" name="messageId" id="messageId" value=""/>
                                            </div>
                                            <div class="modal-footer bg-white">
                                                <button onclick="deleteMessage()" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Modal window for bulk delete -->
                                <div class="bulk_remove_form modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title">Warning</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure that you want to permanently delete the selected item(s)?
                                            </div>
                                            <div class="modal-footer">
                                                <button onclick="bulkRemoveMessage()" class="btn btn-danger">Delete</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- END container-fluid -->
        </div>
        <!-- END content -->
    </div>
    <!-- END content-page -->
    <!-- modals for delete-->
    <!-- Large modal -->

@endsection
@section('scripts')
    <script>
        function bulkRemoveMessage() {
            var selected = new Array();
            $('input[name*=\'selected\']:checked').each(function () {
                selected.push($(this).val());
            });
            if (selected.length > 0) {
                $.ajax({
                    url: "message/bulkRemove",
                    type: 'POST',
                    data: {selected: selected},
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', '@php echo csrf_token(); @endphp');
                    },
                    success: function (response) {
                        if (response.status == 'success') {
                            $('input[name*=\'selected\']').prop('checked', false);
                            location.reload();
                        } else {
                            $('.modal-backdrop').hide();
                            $(".bulk_remove_form").hide();
                            $('#displayErrors').html(
                                '<div class="alert alert-danger" role="alert">\n' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                                '<h4 class="alert-heading">Something went wrong. Please try again!</h4>\n' +
                                '</div>');
                        }
                    }
                });
            } else {
                $('.modal-backdrop').hide();
                $('.bulk_remove_form ').hide();
                $('#displayErrors').html(
                    '<div class="alert alert-danger" role="alert">\n' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>\n' +
                    '<h6 class="alert-heading"><i class="fa fa-warning"></i> ' +
                    'Please select at least one Message!</h6>\n' +
                    '</div>');
                setTimeout(function () {
                    $('#displayErrors div.alert').fadeOut();
                }, 3000);
            }
        }

        $(document).on("click", ".removeMessage", function () {
            var messageId = $(this).data('id');
            $("#removeMessageItem #messageId").val(messageId);
            $('#removeMessageItem').modal('show');
        });

        function deleteMessage() {
            var id = $('input#messageId').val();
            var deleteForm = '<form method="post" action="message/destroy">' +
                '<input name="id" value="' + id + '"/>' +
                '<input name="_method" value="delete"/>' +
                '<input name="_token" value="{{csrf_token()}}"/>' +
                '</form>';
            $(deleteForm).appendTo('body').submit();
        }

        function replyMessage(id,email,subject) {
            $("input#replyMessageTo").val(email);
            $("input#replyMessageSubject").val(subject);
            $("input#replyMessageId").val(id);
            $('#modal_reply_message').modal('show');
        }
        $(document).ready(function() {
            $('#admin-messsage-table').DataTable();
        } );
    </script>
@endsection