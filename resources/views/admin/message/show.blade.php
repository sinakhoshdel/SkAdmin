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
                        @if ($messageText = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $messageText }}</strong>
                            </div>
                        @endif

                        @if ($messageText = Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $messageText  }}</strong>
                            </div>
                        @endif

                        {{--Reply modal box--}}
                        <div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true"
                             id="modal_reply_message">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{url('admin/message/ReplyMessage')}}" method="post">
                                        {{csrf_field()}}
                                        <input type="hidden" name="messageId" value="{{$message->id}}">
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
                                                        <input readonly class="form-control" name="To" type="text" value="{{$message->email}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Subject</label>
                                                        <input readonly class="form-control" name="subject" type="text" value="{{$message->subject}}"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Message (optional)</label>
                                                        <textarea class="form-control" name="message" rows="4"></textarea>
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
                        <div class="card mb-3" id="printMessage">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-4">
                                        From : {{$message->email}} - {{$message->first_name}} {{$message->last_name}}<br>
                                        Date : {{$message->created_at->format('Y.m.d H:i a')}}
                                    </div>
                                    <div class="col-md-8 topButton text-right">
                                        <a onclick="PrintElem('#printMessage');" class="text-white btn btn-dark btn-sm" title="Print"><i class="fa fa-print"></i> Print</a>
                                        <a  onclick="replyMessage()" type="button" class="text-white btn btn-dark btn-sm"><i class="fa fa-reply"></i> Reply</a>
                                        <a title="Delete" type="button" data-id="{{$message->id}}" class="text-white removeMessage btn btn-danger btn-sm">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                        <a href="{{url('admin/message')}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- end card-header -->
                            <div class="card-body table-responsive">
                                <div class="col-md-12">
                                    <h1>{{$message->subject}}</h1>
                                    <p class="text-justify">{{$message->message}}</p>
                                </div>
                            </div>
                            <!-- end card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-4">
                                        From : {{$message->email}}<br>
                                        Date : {{$message->created_at->format('Y.m.d H:i a')}}
                                    </div>
                                    <div class="col-md-8 topButton text-right">
                                        <a onclick="PrintElem('#printMessage');" class="btn btn-outline-dark btn-sm" title="Print"><i class="fa fa-print"></i> Print</a>
                                        <a  onclick="replyMessage()" type="button" class="btn btn-outline-dark btn-sm"><i class="fa fa-reply"></i> Reply</a>
                                        <a title="Delete" type="button" data-id="{{$message->id}}" class="text-danger removeMessage btn btn-outline-danger btn-sm">
                                            <i class="fa fa-trash-o"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->
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


@endsection
@section('scripts')
    <script type="text/javascript">
        function PrintElem(elem) {
            Popup($(elem).html());
        }

        function Popup(data) {
            var myWindow = window.open('', '', 'height=400,width=600');
            myWindow.document.write('<html><head>');
            myWindow.document.write('</head><body >');
            myWindow.document.write(data);
            myWindow.document.write('</body></html>');
            myWindow.document.close();
            myWindow.onload=function(){
                myWindow.focus();
                myWindow.print();
                myWindow.close();
            };
        }

        $(document).on("click", ".removeMessage", function () {
            var messageId = $(this).data('id');
            $("#removeMessageItem #messageId").val(messageId);
            $('#removeMessageItem').modal('show');
        });

        function deleteMessage() {
            var id = $('input#messageId').val();
            var deleteForm = '<form method="post" action="{{route('message.destroy','+id+')}}">' +
                '<input name="id" value="' + id + '"/>' +
                '<input name="_method" value="delete"/>' +
                '<input name="_token" value="{{csrf_token()}}"/>' +
                '</form>';
            $(deleteForm).appendTo('body').submit();
        }

        function replyMessage(id,email,subject) {
            $('#modal_reply_message').modal('show');
        }

    </script>
@endsection