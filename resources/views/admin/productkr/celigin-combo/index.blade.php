@extends('layouts.admin')

@section('content')
    <input type="hidden" id="headerdata" value="{{ __('Celigin Combo') }}">
    <div class="content-area">
        <div class="mr-breadcrumb">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="heading">{{ __('Celigin Combo') }}</h4>
                    <ul class="links">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <li>
                            <a href="javascript:;">{{ __('Celigin Combo') }}</a>
                        </li>
                        <li>
                            <a href="{{ route('admin-prod-index') }}">{{ __('All Celigin Combo') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="product-area">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mr-table allproduct">
                        @include('alerts.admin.form-success')

                        <div class="table-responsive">
                            <table id="celiginCombo" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>{{ __('id') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title">{{ __('Confirm Delete') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>{{ __('You are about to delete this Celigin Combo.') }}</p>
                    <p>{{ __('Do you want to proceed?') }}</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <form action="" class="d-inline delete-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- DELETE MODAL ENDS --}}
@endsection

@section('scripts')
    {{-- DATA TABLE --}}
    <script type="text/javascript">
        (function($) {
            "use strict";

            var table = $('#celiginCombo').DataTable({
                ordering: false,
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin-celigin-combo-datatables') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'category_name', name: 'category_name' },
                    { data: 'product_name', name: 'product_name' },
                    { data: 'action', searchable: false, orderable: false }
                ],
                drawCallback: function(settings) {
                    $('.select').niceSelect();
                }
            });

            $(function() {
                $(".btn-area").append(`
                    <div class="col-sm-4 table-contents">
                        <a class="add-btn" href="{{ route('admin-celigin-combo-create') }}">
                            <i class="fas fa-plus"></i> <span class="remove-mobile">{{ __('Add Celigin Combo') }}</span>
                        </a>
                    </div>
                `);
            });

            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data.success) {
                            window.location.reload();
                        }
                    }
                });
            });

        })(jQuery);
    </script>
    {{-- DATA TABLE ENDS --}}
@endsection

