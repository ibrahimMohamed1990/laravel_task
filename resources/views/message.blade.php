<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 pt-5">
                    <div class="form-group">
                        
                        <label class="ff">choose a category</label>
                        <select class="form-control" aria-label=".form-select-lg example">
                            <option selected disabled>---</option>
                             @foreach ($cats as $cat) 
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                             @endforeach 
                          </select> 
                          <div class="loader_ico" style="display:none;text-align: center;padding-top: 30px;
                          font-size: 22px;"><i class="fa-solid fa-spinner fa-spin-pulse fa-spin"></i></div>
                      </div> 
                </div>
                <div class="col-md-3"></div>
            </div>

        </div>
    
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
        </script>
            <script>
                $(document).on("change","select",function(e) { 
                    $('.loader_ico').show();
                        var select = $(this);  
                        select.nextAll('select').remove();
                        select.nextAll('label').remove();
                        $('.no_sub').remove();
                        $.ajaxSetup({
                        headers: { 
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        }); 
                   $.ajax({ 
                      url:"/cats",
                      type:'POST',
                      data:{'cat_id':select.val()},
                      success:function(data) { 
                        if(data.length > 0){
                            select.after('<label>choose sub category</label><select class="form-control"><option>---</option></select>');
                            $.each(data, function(val, text) {
                                     $('select').last().append($("<option />").val(text.id).text(text.name));
                                });
                        }else{
                            select.after('<p class="no_sub">no sub cats</p>')
                        }
                        $('.loader_ico').hide();  
                 
                      }
                   });

                });
             
               
             </script>
    </body>
</html>
