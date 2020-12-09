@extends('layout/layout')

@section('main_contend')

    <div class="jumbotron mt-5">


        @if ($message = Session::get('success'))

            <div class="alert alert-success alert-block mb-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>

        @endif

        <h1 class="mb-4">Создать список</h1>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('check.list') }}">
            @csrf
            <select class="custom-select mb-3" name="type" id="catageory_type">
                <option selected disabled>Выберите тип</option>
                <option value="true">Доход</option>
                <option value="false">Расход</option>
            </select>

            <div class="form-group">
                <input type="number" class="form-control" name="money" id="money" aria-describedby="emailHelp" placeholder="СУММА">
            </div>

            <div class="form-group">
                <textarea class="form-control" name="comment" rows="3"></textarea>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group input-group">
                        <input type="text" class="form-control" value="" name="date" id="date" placeholder="2020-12-08" autocomplete="off">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group input-group">
                        <input type="time" class="form-control" value="" name="time" placeholder="2020-12-08" autocomplete="off">
                    </div>
                </div>
            </div>

            <select class="custom-select mb-5" name="category" id="sub_category">
            </select>

            <button type="submit" class="btn btn-primary">Создать список</button>
        </form>
    </div>


    <script>

        $(document).ready(function () {

            // $('#money').on('change', function (e) {
            //     // console.log(e.target.value);
            //
            //     // Strip all characters but numerical ones.
            //     function number_format (number, decimals, dec_point, thousands_sep) {
            //         // Strip all characters but numerical ones.
            //         number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            //         var n = !isFinite(+number) ? 0 : +number,
            //             prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            //             sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            //             dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            //             s = '',
            //             toFixedFix = function (n, prec) {
            //                 var k = Math.pow(10, prec);
            //                 return '' + Math.round(n * k) / k;
            //             };
            //         // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            //         s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            //         if (s[0].length > 3) {
            //             s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            //         }
            //         if ((s[1] || '').length < prec) {
            //             s[1] = s[1] || '';
            //             s[1] += new Array(prec - s[1].length + 1).join('0');
            //         }
            //         return s.join(dec);
            //     }
            //     var chanAnmout = number_format(e.target.value, 2, '.', ' ');
            //     e.target.value = chanAnmout;
            //     // console.log(e.target.value);
            // })

            $('#date').datepicker({
                setDate: new Date(),
                autoclose: true,
                format: 'yyyy-mm-dd',
                endDate: new Date(),
            });

            $('#catageory_type').on('change', function () {
                let id = $(this).val();
                $('#sub_category').empty();
                $('#sub_category').append(`<option value="0" disabled selected>Выберите категории</option>`);
                $.ajax({
                    type: 'GET',
                    url: 'getSubCat/' + id,
                    success: function (response) {
                        var response = JSON.parse(response);
                        $('#sub_category').empty();
                        $('#sub_category').append(`<option value="0" disabled selected>Выберите категории</option>`);
                        response.forEach(element => {
                            $('#sub_category').append(`<option value="${element['id']}">${element['name']}</option>`);
                        });
                    },
                    // error: console.log(error),
                });
            });
        });

    </script>

@endsection

