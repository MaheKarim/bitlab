@extends($activeTemplate.'layouts.frontend')

@section('content')
    <div class="container pt-120 pb-120">
        <div class="row gy-5 justify-content-center">
            <div class="col-lg-10">
                <div class="widget__ticket">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <h6 class="widget__ticket-title mb-4 me-2">

                            @php echo $myTicket->statusBadge; @endphp
                            <span>@lang('Ticket Id')</span>
                            <span>#{{ $myTicket->ticket }}</span>
                        </h6>
                        @if($myTicket->status != 3)
                            <a href="#0" class="cmn--btn mb-4">
                                <b class="close-button" title="@lang('Close Ticket')" data-bs-toggle="modal" data-bs-target="#DelModal">
                                    <i class="las la-times"></i>
                                </b>
                            </a>
                        @endif
                    </div>
                    <div class="message__chatbox__body">
                        @if($myTicket->status != 4)
                            <form class="message__chatbox__form row" method="post" action="{{ route('ticket.reply', $myTicket->id) }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="replayTicket" value="1">
                                <div class="form--group col-sm-12">
                                    <textarea id="inputMessage" class="form-control form--control bg--body" name="message"></textarea>
                                </div>
                                <div class="form--group col-sm-12">
                                    <div class="d-flex">
                                        <div class="left-group col p-0">
                                            <button type="button" class="btn btn-dark btn-sm addAttachment"> <i class="fas fa-plus"></i> @lang('Add Attachment') </button>
                                            <p class="my-1 fs-14"><span class="text--info">@lang('Max 5 files can be uploaded | Maximum upload size is '.convertToReadableSize(ini_get('upload_max_filesize')) .' | Allowed File Extensions: .jpg, .jpeg, .png, .pdf, .doc, .docx')</span></p>
                                            <div class="row fileUploadsContainer gy-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form--group col-sm-12 mb-0">
                                    <button type="submit" class="cmn--btn">@lang('Reply')</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="widget__ticket">
                    <div class="message__chatbox__body">
                        <ul class="reply-message-area">
                            @foreach($messages as $message)
                                <li>
                                    @if($message->admin_id == 0)
                                        <div class="reply-item">
                                            <div class="name-area">
                                                <h6 class="title">{{ $message->ticket->name }}</h6>
                                            </div>
                                            <div class="content-area">
                                            <span class="meta-date">
                                                @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}
                                            </span>
                                                <p>{{$message->message}}</p>
                                                @if($message->attachments()->count() > 0)
                                                    <div class="mt-2">
                                                        @foreach($message->attachments as $k=> $image)
                                                            <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="las la-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <ul>
                                            <li>
                                                <div class="reply-item">
                                                    <div class="name-area">
                                                        <h6 class="title">{{ $message->admin->name }}</h6>
                                                    </div>
                                                    <div class="content-area">
                                                    <span class="meta-date">
                                                        @lang('Posted on') {{ $message->created_at->format('l, dS F Y @ H:i') }}
                                                    </span>
                                                        <p>{{$message->message}}</p>
                                                        @if($message->attachments()->count() > 0)
                                                            <div class="mt-2">
                                                                @foreach($message->attachments as $k=> $image)
                                                                    <a href="{{route('ticket.download',encrypt($image->id))}}" class="mr-3"><i class="las la-file"></i>  @lang('Attachment') {{++$k}} </a>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('ticket.reply', $myTicket->id) }}">
                    @csrf
                    <input type="hidden" name="replayTicket" value="2">
                    <div class="modal-header">
                        <h5 class="modal-title"> @lang('Confirmation')!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <strong class="text-dark">@lang('Are you sure you want to close this support ticket')?</strong>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--danger cmn--btn btn--sm" data-bs-dismiss="modal">@lang('Close')</button>
                        <button type="submit" class="btn btn--success cmn--btn btn--sm">@lang("Confirm")
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        "use strict";
        var fileAdded = 0;
        $('.addAttachment').on('click',function(){
            fileAdded++;
            if (fileAdded == 5) {
                $(this).attr('disabled',true)
            }
            $(".fileUploadsContainer").append(`
                    <div class="col-lg-4 col-md-12 removeFileInput">
                            <div class="input-group">
                                <input type="file" name="attachments[]" class="form-control form--control" accept=".jpeg,.jpg,.png,.pdf,.doc,.docx" required>
                                <button type="button" class="input-group-text removeFile bg--danger border--danger"><i class="fas fa-times"></i></button>
                            </div>
                    </div>
                `)
        });
        $(document).on('click','.removeFile',function(){
            $('.addAttachment').removeAttr('disabled',true)
            fileAdded--;
            $(this).closest('.removeFileInput').remove();
        });
    </script>
@endpush
