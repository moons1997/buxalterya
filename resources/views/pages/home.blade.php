@extends('layout.layout')

@section('title')
    Home
@endsection

@section('main_contend')
    <div class="home-block">
        <div class="sort">
            <h3>Сортировать по дате</h3>
            <form method="POST" action="{{ route('check.filter') }}">
                @csrf
            <div class="row justify-content-center">
                    <div class="col-lg-8">
                            <div class="input-group input-daterange">
                                <input type="text" class="form-control" value="" name="startDate" autocomplete="off" required>
                                <div class="input-group-addon pl-2 pr-2">to</div>
                                <input type="text" class="form-control" value="" name="endDate" autocomplete="off" required>
                            </div>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success">Сортировать</button>
                    </div>
            </div>
            </form>

            <div class="balance-info d-flex">
                <div class="income">
                    + <?=number_format($profit, 2, '.', ' ') ?> сум
                </div>
                <div class="cost">
                    - <?=number_format($spend, 2, '.', ' ') ?> сум
                </div>
            </div>
        </div>


        <div class="total_info">
            @if($data)
                    @foreach($data as $item)
                        <div id="accordion">
                            <div class="card">
                                <div class="card-header" id="heading_{{$item->id}}" data-target="#collapse_{{$item->id}}" data-toggle="collapse"  aria-expanded="true" aria-controls="collapse_{{$item->id}}">
                                    <h5 class="mb-0">
                                        @if($item->type)
                                            <span class="badge badge-pill badge-primary">Доход</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">Расход</span>
                                        @endif
                                        <button class="btn btn-link" >
                                            {{$item->date. ' ' . $item->time}}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse_{{$item->id}}" class="collapse" aria-labelledby="heading_{{$item->id}}" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <?=number_format($item->money, 2, '.', ' ') ?> сум
                                            </div>
                                            <div class="col-lg-9">
                                                {{ $item->category[0]->name }}
                                            </div>
                                            @if($item->comment)
                                                <div class="col-lg-12 mt-2">
                                                    <h5><i>Комментарий</i></h5>
                                                    {{$item->comment}}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
            @endif
        </div>

    </div>
    <script>

        $('.input-daterange input').each(function() {
            $(this).datepicker({
                setDate: new Date(),
                autoclose: true,
                format: 'yyyy-mm-dd',
                endDate: new Date(),
            });
        });
    </script>
@endsection
