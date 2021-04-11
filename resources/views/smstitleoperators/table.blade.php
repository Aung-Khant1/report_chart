@extends('master')

@section('title')
    <h3> Table </h3>
@endsection

@section('nav')
   Sms titles by holdernames
@endsection

@section('content')
<div class="mb-5">
    <table id="table_id" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Date</th>
                <th>Sms Title</th>
                <th>Operator</th>
                <th>Sms Count</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($data as $item)
                <tr>
                    <td> {{$i++}} </td>
                    <td> {{$item->date}} </td>
                    <td> {{$item->sms_title}} </td>
                    <td> {{$item->operator}} </td>
                    <td> {{$item->total}} </td>
                </tr>
           
            @endforeach
           
            
        </tbody>
    </table>
</div>



@endsection

@section('js')

<script>
    $(document).ready( function () {
        $('#table_id').DataTable({
            dom: 'Blfrtip',
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            // ajax: '/api/smstitleoperatorsrefresh',
            buttons: [
                'copy', 
                'csv', 
                'excel', 
                'print',
                
            ], 
            'ordering': true,
            'searching': true,
            'info': true,
            "serverSide": false,

        });
    } );
</script>
@endsection