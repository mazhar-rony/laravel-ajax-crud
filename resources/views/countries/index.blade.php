<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--  CSRF Token  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ajax-CRUD</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    {{--  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</head>
<body>
    <div class="container">
    
        <div class="row justify-content-center mt-5">

            <div class="col-md-12">
                
                <div id="msg" class="alert" role="alert"></div>

                <div class="card">
                    <div class="card-header">Country List
                         {{--  Button trigger modal  --}}
                         <button id="addCountry" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModal">
                            <i class="fa fa-plus"></i> Add New Country</i>
                        </button>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Country Name</th>
                                    <th>Capital</th>
                                    <th>Population</th>  
                                    <th>Action</th>                              
                                </tr>
                            </thead>
                            <tbody id="country_table">
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->capital }}</td>
                                        <td>{{ $country->population }}</td>
                                        <td>
                                            <a href="" class="btn btn-warning btn-sm edit_country" data-country="{{$country}}">Edit</a> |
                                            <a href="" class="btn btn-danger btn-sm delete_country" data-delete="{{$country->id}}">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    
    {{--   Modal --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="validation_msg" class="alert" role="alert">
                    
                </div>

                <form action="" id="country_form">

                    <div class="form-group">
                    <label for="name">Country Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="capital">Capital</label>
                        <input type="text" name="capital" id="capital" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="population">Population</label>
                        <input type="text" name="population" id="population" class="form-control">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Country</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--   Edit Modal --}}

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Country</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div id="validation_msg_edit" class="alert" role="alert">
                    
                </div>

                <form action="" id="country_edit_form">

                    <input type="hidden" name="id">

                    <div class="form-group">
                    <label for="name">Country Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="capital">Capital</label>
                        <input type="text" name="capital" id="capital" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="population">Population</label>
                        <input type="text" name="population" id="population" class="form-control">
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Country</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   
<script>
    $(function(){ 
         
        $('.alert').hide();// hide alert class for delete message when page loads
        
        $('#addCountry').click(clear_modal_form);// clear form value on button click
        
        $('#country_form').submit(function(e){
            e.preventDefault(); // Preventin Auto Form Submitting

            //var name = $('input[name = "name"]').val();
            //var capital = $('input[name = "capital"]').val();
            //var population = $('input[name = "population"]').val();

            //console.log(name, capital, population);
            //console.log($('#country_form').serialize());

            //var form_data = $('#country_form').serialize(); // this == #country_form
            var form_data = $(this).serialize(); //serialize method fetches all form data

            $.ajax({
                url: '/countries',
                method: 'POST',
                data: form_data,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res){
                    //console.log(res, "success");
                    if(!res.status)
                    {
                        $('#validation_msg').addClass('alert-danger').show().html(res.message);
                    }
                    else
                    {
                        $('#validation_msg').addClass('alert-success').show().html(res.message);

                        var res_str = JSON.stringify(res.data);
                        var table_data = `
                        <tr>
                            <td>${res.data.id}</td>
                            <td>${res.data.name}</td>
                            <td>${res.data.capital}</td>
                            <td>${res.data.population}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm edit_country" data-country='${res_str}'>Edit</a> |
                                <a href="#" class="btn btn-danger btn-sm delete_country" data-delete='${res.data.id}'>Delete</a>
                            </td>
                        </tr>`

                        $('#country_table').append(table_data);

                        clear_modal_form();
                        
                    }

                    hide_alert();
                    
                },

                error: function(res){
                    console.log(res);
                }
            });

        });

        //================= Edit Country ================

        /*$('.edit_country').click(function(e){
            
            e.preventDefault();
            console.log($(this).data('country'));

            $('#editModal').modal('show');
        });*/

        // for Dynamic load data
        $('body').on('click', '.edit_country', function(e){
            
            e.preventDefault();

            var country = $(this).data('country');
            
            $('#editModal form input[name = "id"]').val(country.id);
            $('#editModal form input[name = "name"]').val(country.name);
            $('#editModal form input[name = "capital"]').val(country.capital);
            $('#editModal form input[name = "population"]').val(country.population);

            $('#editModal').modal('show');
        //});

        //================= Update Country ===============

            $('#country_edit_form').submit(function(e){
                e.preventDefault(); // Preventin Auto Form Submitting

                //var name = $('input[name = "name"]').val();
                //var capital = $('input[name = "capital"]').val();
                //var population = $('input[name = "population"]').val();

                //console.log(name, capital, population);
                //console.log($('#country_edit_form').serialize());

                //var form_data = $('#country_edit_form').serialize(); // this == #country_edit_form
                var form_data = $(this).serialize(); //serialize method fetches all form data

                var country_id =  $('#editModal form input[name = "id"]').val();
                
                //console.log(form_data);
                console.log(country_id);
                //return;

                $.ajax({
                    url: '/countries/'+country_id,
                    method: 'PATCH',
                    data: form_data,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(res){
                        //console.log(res, "success"); return;
                        if(!res.status)
                        {
                            $('#validation_msg_edit').addClass('alert-danger').show().html(res.message);
                        }
                        else
                        {
                            $('#validation_msg_edit').addClass('alert-success').show().html(res.message);                            
                            
                            $("#country_table td:contains('" + country.name + "')").html(res.data.name);
                            $("#country_table td:contains('" + country.capital + "')").html(res.data.capital);
                            $("#country_table td:contains('" + country.population + "')").html(res.data.population);
                            
                            $('#editModal form input[name = "name"]').val(res.data.name);
                            $('#editModal form input[name = "capital"]').val(res.data.capital);
                            $('#editModal form input[name = "population"]').val(res.data.population);

                            // Refresh Window after Modal goes Hidden to get latest data on edit form
                            $('#editModal').on('hidden.bs.modal', function () {
                                window.location.reload();
                              })
                        }
                        
                        hide_alert();
                    },

                    error: function(res){
                        console.log(res);
                    }
                });
            });
        });

        //================= Delete Country ===============

        $('body').on('click', '.delete_country', function(e){
            e.preventDefault(); // Preventin Auto Form Submitting

            var row = $(this).parent().parent();
            var country_id =  $(this).data('delete');

            //console.log(country_id);
            //return;

            $.ajax({
                url: '/countries/'+country_id,
                method: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(res){
                    
                    console.log(res, "success");
                    

                    if(!res.status)
                    {
                        $('#msg').addClass('alert-danger').show().html(res.message);                        
                    }
                    else
                    {
                        $('#msg').addClass('alert-success').show().html(res.message);
                        
                        row.fadeOut(1000);
                    }

                    hide_alert();
                },

                error: function(res){
                    console.log(res);
                }
            });

        });

        //================= Hide Alert ===================

        function hide_alert(){
            setTimeout(() => {
                $('.alert').removeClass('alert-danger').removeClass('alert-success').fadeOut();
            }, 2000);
        }

        //================= Clear Modal Form =============

        function clear_modal_form(){
            $('#exampleModal form input[name = "name"]').val('');
            $('#exampleModal form input[name = "capital"]').val('');
            $('#exampleModal form input[name = "population"]').val('');
        }
    });
</script>

</body>
</html>