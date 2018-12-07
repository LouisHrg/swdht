@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Notes de frais
                </div>
                <div class="card-body">
                   <a href='/new_expense_report' class="btn btn-outline-primary">Déclarer une nouvelle note de frais</a>
                    <br><br>
                    <table class="table">
                      <thead>
                        <tr>
                            <th>Amount</th>
                            <th>Provider</th>
                            <th>Personne</th>
                            <th>Date</th>
                            <th colspan=3>Actions</th>
                        </tr>
                      </thead>
                        @foreach ($expenseReports as $expenseReport)
                        <tr>
                            <td>{{ $expenseReport->amount }}</td>
                            <td>{{ $expenseReport->provider}}</td>
                            <td>{{ $expenseReport->user->name }}</td>
                            <td>{{ $expenseReport->date_expense}}</td>
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <td><a href='{{ route('show_expense_report', ['id' => $expenseReport->id]) }}' class="btn btn-secondary" >View</a></td>
                              <td><a href='{{ route('modify_expense_report', ['id' => $expenseReport->id]) }}' class="btn btn-secondary" >Edit</a></td>
                              <td><a onclick="return confirm('Est-ce votre dernier mot?');" href='{{ route('delete_expense_report', ['id' => $expenseReport->id]) }}' class="btn btn-secondary" >Delete</a></td>
                            </div>
                        </tr>
                        @endforeach
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

