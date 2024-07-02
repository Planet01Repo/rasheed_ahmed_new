var delay;

function initComp
()
{

    // $("form").validationEngine({promptPosition: "topRight", scroll: false,opacity:0.50});
    
    $('.ajaxFormSubmitAlter').on('click',function(e){
        //e.preventDefault();
        var form = $('form.ajaxForm');
        var check  = form.valid();
        if(!check){
            // $("#loader-form").hide();
            $("#loader").hide();
            return false;
        } 
        $("button[type=button]").attr("disabled",'disabled');
        $("button[type=submit]").attr("disabled",'disabled');
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('select').prop('disabled', false);
            form.submit();

            // swal("Data has been saved", { icon: "success",});
          } else {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            // $("#loader-form").hide();
            $("#loader").hide();

            return false;
          }
        });
    });

    $('.ajaxFormSubmitAlter4').on('click',function(e){
        //e.preventDefault();
        var form = $('form.ajaxForm4');
        var check  = form.valid();
        if(!check){
            // $("#loader-form").hide();
            $("#loader").hide();
            return false;
        } 


        $("button[type=button]").attr("disabled",'disabled');
        $("button[type=submit]").attr("disabled",'disabled');
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('select').prop('disabled', false);
            form.submit();

            // swal("Data has been saved", { icon: "success",});
          } else {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            // $("#loader-form").hide();
            $("#loader").hide();

            return false;
          }
        });
    });

    $("form.ajaxForm").ajaxForm({
        dataType: "json",
        beforeSubmit: function() {
            // $("#loader-form").show();
            $(".loading-wrapper").show();
            $("#loader").show();
            faction = $("form.login").attr("action");
            $("button[type=button]").attr("disabled",'disabled');
            $("button[type=submit]").attr("disabled",'disabled');
            // if (faction == undefined)
            // {
                // if( ! $("form.ajaxForm").hasClass('nopopup') ){
                //     r = confirm("Are you sure?");
                //   if (!r){
                //       $("button[type=submit]").removeAttr("disabled");
                //       $("#loader").hide();
                //       return false;
                //   }
                // }
            // }
        },
        error: function(data)
        {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            // $("#loader-form").hide();
            $("#loader").hide();
            $(".loading-wrapper").hide();

            if(typeof data === 'object'){
               error("Please fill all mandatory fields.");   
            }else{
             error("Error Occured.Invalid File Format.");   
            }

            // error("Error Occured.Invalid File Format.");
            //$('#loader-form').delay(400).fadeOut(400);
            /*setTimeout(
              function()
              {
              }, 400);*/
        },
        success: function(data) {
            /*$("#loader").hide();*/
            //$('#loader-form').delay(400).fadeOut(400);
            /*setTimeout(
              function()
              {
              }, 400)*/;
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            if (data == null || data == "")
            {
                window.location.reload(true);
            }
            else if (data['error'] !== undefined)
            {
                error(data['error']);
                $("#loader").hide();
                $(".loading-wrapper").hide();

                // $("#loader-form").hide();

            }
            else if (data['success'] !== undefined){
                $("#loader").hide();
                $(".loading-wrapper").hide();
                success(data['success']);
            }
            if (data['redirect'] !== undefined){
                window.setTimeout(function() { window.location = data['redirect']; }, 2000);
                
            }
            if (data['reload'] !== undefined){
                window.location.reload(true);
            }
            if (data['fieldsEmpty'] == 'yes'){

                resetForm();

            }
        }
    });
     $("form.ajaxForm4").ajaxForm({
        dataType: "json",
        beforeSubmit: function() {
            // $("#loader-form").show();
            $("#loader").show();
            // if (faction == undefined)
            // {
                // if( ! $("form.ajaxForm").hasClass('nopopup') ){
                //     r = confirm("Are you sure?");
                //   if (!r){
                //       $("button[type=submit]").removeAttr("disabled");
                //       $("#loader").hide();
                //       return false;
                //   }
                // }
            // }
        },
        error: function()
        {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            // $("#loader-form").hide();
            $("#loader").hide();
            // error("Error Occured.Invalid File Format.");
             error("Error Occured.Invalid File Format.");
            //$('#loader-form').delay(400).fadeOut(400);
            /*setTimeout(
              function()
              {
              }, 400);*/
        },
        success: function(data) {
            /*$("#loader").hide();*/
            //$('#loader-form').delay(400).fadeOut(400);
            /*setTimeout(
              function()
              {
              }, 400)*/;
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            if (data == null || data == "")
            {
                window.onbeforeunload = null
                window.location.reload(true);
            }
            else if (data['error'] !== undefined)
            {
                error(data['error']);
                $("#loader").hide();
                // $("#loader-form").hide();

            }
            else if (data['success'] !== undefined){
                success(data['success']);
            }
            if (data['redirect'] !== undefined){
                window.onbeforeunload = null
                window.setTimeout(function() { window.location = data['redirect']; }, 2000);
                
            }
            if (data['reload'] !== undefined){
                window.onbeforeunload = null               
                window.location.reload(true);
            }
            if (data['fieldsEmpty'] == 'yes'){

                resetForm();

            }
        }
    });

     $('.ajaxFormSubmitAlter2').on('click',function(e){
        //e.preventDefault();
        var form = $('form.ajaxForm2');
        var check  = form.valid();
        if(!check){
            return false;
        } 
        $("button[type=button]").attr("disabled",'disabled');
        $("button[type=submit]").attr("disabled",'disabled');
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $('select').prop('disabled', false);
            form.submit();
            // swal("Data has been saved", { icon: "success",});
          } else {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            // $("#loader-form").hide();
            return false;
          }
        });
    });

     $('.ajaxFormSubmitAlter3').on('click',function(e){
        //e.preventDefault();
        var form = $('form.ajaxForm2');
        var check  = form.valid();
        if(!check){
            return false;
        } 
        var post_url = $('.ajaxForm2').attr("action"); //get form action url
        var form_data =  $('.ajaxForm2').serialize() //Encode form elements for 
        $("button[type=button]").attr("disabled",'disabled');
        $("button[type=submit]").attr("disabled",'disabled');
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $("#loader").show();
            $.ajax({
                url : post_url,
                type: 'POST',
                data : form_data
            }).done(function(response){ //
                var data = JSON.parse(response);
                success(data.success);
                if (data.redirect !== undefined){
                    window.onbeforeunload = null;
                    window.location.reload(true);
                }
                //$("#loader").hide();
                //$("#server-results").html(response);
            });
          } else {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            $("#loader").hide();
            return false;
          }
        });
    });

     $("form.ajaxForm2").ajaxForm({
        dataType: "json",
        beforeSubmit: function() {
            $("#loader").show();
            faction = $("form.login").attr("action");
            $("button[type=button]").attr("disabled",'disabled');
            $("button[type=submit]").attr("disabled",'disabled');
            // if (faction == undefined)
            // {
                // if( ! $("form.ajaxForm").hasClass('nopopup') ){
                //     r = confirm("Are you sure?");
                //   if (!r){
                //       $("button[type=submit]").removeAttr("disabled");
                //       $("#loader").hide();
                //       return false;
                //   }
                // }
            // }
        },
        error: function()
        {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            $("#loader").hide();
            error("Error Accured.Invalid File Format.");
        },
        success: function(data) {
            $("button[type=button]").removeAttr("disabled");
            $("button[type=submit]").removeAttr("disabled");
            if (data == null || data == "")
            {
                window.location.reload(true);
            }
            else if (data['error'] !== undefined)
            {
                error(data['error']);
                $("#loader").hide();
            }
            else if (data['success'] !== undefined){
                success(data['success']);
            }
            if (data['redirect'] !== undefined){
                  window.location = data['redirect'];
                 //window.setTimeout(function() { window.location = data['redirect']; }, 2000);
                
            }
            if (data['reload'] !== undefined){
                window.location.reload(true);
            }
            if (data['fieldsEmpty'] == 'yes'){

                resetForm();

            }
        }
    });
    delay = function(ms, func) {
        return setTimeout(func, ms);
    };
    
    toastr.options = {
        positionClass: 'toast-bottom-left'
    };

    
    $("#example3").on("click", ".ajaxBtnAlter", function(event){
        event.preventDefault();
        $("#loader").show();
        href = $(this).attr("href");
        rel = $(this).attr("rel");
        ele=$(this);
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: href,
                dataType: "json",
                error: function(jqXHR, textStatus, errorThrown){
                    $("#loader").hide();
                    error("Request not completed.Please try Again");
                },
                success: function(data) {
                    $("#loader").hide();
                    if (data == null || data == "")
                    {
                        window.onbeforeunload = null;
                        window.location.reload(true);
                    }
                    if (data['error'] !== undefined)
                    {
                        error(data['error']);
                    }
                    if (data['success'] !== undefined)
                    {
                        success(data['success']);
                    }
                    if(data['details']){
                        $(ele).parent().parent().parent().remove();
                        $(ele).parent().parent().parent().remove();
                    }
                    if (data['redirect'] !== undefined)
                    {    window.onbeforeunload = null;
                        setTimeout(function(){
                            window.location = data['redirect'];
                        },1500);
                    }
                    if (data['deleteRow'] !== undefined)
                    {
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                        
                    }

                    if (data['detailsDelete'] !== undefined)
                    {
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                        
                    }
                    
                    if (data['reload'] !== undefined)
                    {   window.onbeforeunload = null;
                        window.location.reload(true);
                    }
                    if (data['fieldsEmpty'] == 'yes'){

                        resetForm();

                    }
                }
            });
            // swal("Data has been saved", { icon: "success",});
          } else {
            $("#loader").hide();
            return false;
          }
        });
        $("#loader").hide();
        return false;
    });
    
    $("#example4").on("click", ".ajaxBtnAlter", function(event){
        event.preventDefault();
        $("#loader").show();
        href = $(this).attr("href");
        rel = $(this).attr("rel");
        ele=$(this);
        swal({
          title: "Are you sure?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
                url: href,
                dataType: "json",
                error: function(jqXHR, textStatus, errorThrown){
                    $("#loader").hide();
                    error("Request not completed.Please try Again");
                },
                success: function(data) {
                    $("#loader").hide();
                    if (data == null || data == "")
                    {
                         window.onbeforeunload = null;
                        window.location.reload(true);
                    }
                    if (data['error'] !== undefined)
                    {
                        error(data['error']);
                    }
                    if (data['success'] !== undefined)
                    {
                        success(data['success']);
                    }
                    if(data['details']){
                        $(ele).parent().parent().parent().remove();
                        $(ele).parent().parent().parent().remove();
                    }
                    if (data['redirect'] !== undefined)
                    {   window.onbeforeunload = null;
                        setTimeout(function(){
                            window.location = data['redirect'];
                        },1500);
                    }
                    if (data['deleteRow'] !== undefined)
                    {
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                        
                    }
                    if (data['detailsDelete'] !== undefined)
                    {
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                        
                    }
                    if (data['reload'] !== undefined)
                    {   window.onbeforeunload = null;
                        window.location.reload(true);
                    }
                    if (data['fieldsEmpty'] == 'yes'){

                        resetForm();

                    }
                }
            });
            // swal("Data has been saved", { icon: "success",});
          } else {
            $("#loader").hide();
            return false;
          }
        });
        $("#loader").hide();
        return false;
    });
    
    
    $(".add_more").click(function() {
        data = $("#add_more_trade").html();
        $("#trade_div").append(data);
    })
    $(".Removediv").click(function() {
        $(this).parent().remove();
    });

    $(".ajaxbtn").on("click", function(event){
        event.preventDefault();
        $("#loader").show();
        $("button[type=submit]").attr("disabled",'disabled');
        href = $(this).attr("href");
        rel = $(this).attr("rel");
        ele=$(this);
        if (rel === "delete")
        {
            var r = confirm("Do you want to perform this action?");
            if (r === true)
            {
                $.ajax({
                    url: href,
                    dataType: "json",
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $("#loader").hide();
                        $("button[type=submit]").removeAttr("disabled");
                        error("Request not completed.Please try Again");
                    },
                    success: function(data) {
                        $("#loader").hide();
                        $("button[type=submit]").removeAttr("disabled");
                        if (data == null || data == "")
                        {
                            window.location.reload(true);
                        }
                        if (data['error'] !== undefined)
                        {
                            error(data['error']);
                        }
                        if (data['success'] !== undefined)
                        {
                            success(data['success']);
                        }
                        if(data['details']){
                            $(ele).parent().parent().parent().remove();
                            $(ele).parent().parent().parent().remove();
                        }
                        if (data['detailsDelete'] !== undefined)
                        {
                            $(ele).closest("tr").remove();
                            $(ele).closest("tr").css("display",'none');
                        }
                        if (data['qoutationMultiTotalSet'] !== undefined)
                        {
                            var mult = 0;
                            // for each row:

                            $("tr.txtMult").each(function() {
                                // get the values from this row:
                                var $quatity_num = $('.quatity_num', this).val();
                                if ($quatity_num == undefined) {
                                    $quatity_num = ($quatity_num == undefined) ? 0 : $quatity_num;
                                }
                                var $rate_num = $('.rate_num', this).val();
                                if ($rate_num == undefined) {
                                    $rate_num = ($rate_num == undefined) ? 0 : $rate_num;
                                }

                                var $discount_type = $('.discount_type', this).val();
                                var $discount_amount = $('.discount_amount', this).val();
                                if ($discount_type != '') {
                                    $discount_amount = ($discount_amount != '') ? $discount_amount : 0;
                                }
                                // console.log("discount_type "+$discount_type);
                                // console.log("discount_amount "+$discount_amount);

                                if ($discount_type == 1) {

                                    if ($discount_amount != '') {
                                        if ($discount_amount <= 100) {
                                            $discount_amount = ($discount_amount / 100) * ($quatity_num * 1) * ($rate_num * 1);
                                        } else {
                                            $discount_amount = ($quatity_num * 1) * ($rate_num * 1);
                                            $('.discount_amount', this).val(100);
                                            // return false;
                                        }
                                    }
                                } else if ($discount_type == 2) {
                                    if ($discount_amount != '') {
                                        $discount_amount = $discount_amount;
                                    }
                                } else {
                                    $('.discount_amount', this).val(0);
                                    $discount_amount = 0;
                                }
                                // console.log("discount_type2 "+$discount_type);
                                // console.log("discount_amount2 "+$discount_amount);
                                var $total = ($quatity_num * 1) * ($rate_num * 1) - $discount_amount;
                                if ($total < 0) {
                                    $total = 0;
                                    $('.discount_amount', this).val(($quatity_num * 1) * ($rate_num * 1));
                                }
                                // else{
                                //   console.log("else");
                                //   $total = 0;
                                // }
                                $('.multTotal', this).val($total).text($total);
                                mult += $total;
                            });
                            $("#subtotal").val(mult).text(mult);

                            var $subtotal = mult;
                            var $total_discount_amount = $('.total_discount_amount').val();
                            var $total_discount_type = $('.total_discount_type').val();
                            if ($total_discount_type != '') {
                                $total_discount_amount = ($total_discount_amount != '') ? $total_discount_amount : 0;
                            }

                            if ($total_discount_type == 1) {
                                if ($total_discount_amount != '') {
                                    if ($total_discount_amount <= 100) {
                                        $total_discount_amount = ($total_discount_amount / 100) * $subtotal;
                                    } else {

                                        $total_discount_amount = $subtotal;
                                        $('.total_discount_amount').val(100);
                                        // return false;
                                    }
                                }
                            } else if ($total_discount_type == 2) {
                                if ($total_discount_amount != '') {
                                    $total_discount_amount = $total_discount_amount;
                                }
                            } else {
                                $('.total_discount_amount').val(0);
                                $total_discount_amount = 0;
                            }

                            var $grandtotal = $subtotal - $total_discount_amount;

                            if ($grandtotal < 0) {
                                $grandtotal = 0;
                                $('.total_discount_amount').val($subtotal);
                            }
                            $('#grandtotal').val($grandtotal).text($grandtotal); 
                        }
                        if (data['invoiceMultiTotalSet'] !== undefined)
                        {
                            var mult = 0;
                           // for each row:
                           
                            $("tr.txtMult").each(function () {
                               // get the values from this row:
                               var $quatity_num = $('.quatity_num', this).val();
                              if($quatity_num == undefined){
                                $quatity_num = ($quatity_num == undefined)?0:$quatity_num;
                              }
                              var $rate_num = $('.rate_num', this).val();
                              if($rate_num == undefined){
                                $rate_num = ($rate_num == undefined)?0:$rate_num;
                              }

                              var $discount_type = $('.discount_type', this).val();
                              var $discount_amount = $('.discount_amount', this).val();
                              if($discount_type != ''){
                                $discount_amount = ($discount_amount != '')?$discount_amount:0;
                              }
                              // console.log("discount_type "+$discount_type);
                              // console.log("discount_amount "+$discount_amount);

                              if ($discount_type == 1) {

                                if($discount_amount != ''){
                                  if ($discount_amount <= 100) {
                                    $discount_amount = ($discount_amount / 100) * ($quatity_num * 1) * ($rate_num * 1);
                                  }else{
                                    $discount_amount = ($quatity_num * 1) * ($rate_num * 1);
                                    $('.discount_amount',this).val(100);
                                    // return false;
                                  }
                                }
                              }else if ($discount_type == 2){
                                if($discount_amount != ''){
                                  $discount_amount = $discount_amount;
                                }
                              }else{
                                $('.discount_amount',this).val(0);
                                $discount_amount = 0;
                              }
                              // console.log("discount_type2 "+$discount_type);
                              // console.log("discount_amount2 "+$discount_amount);
                              var $total = ($quatity_num * 1) * ($rate_num * 1) - $discount_amount;
                              if($total < 0){
                                $total = 0;
                                $('.discount_amount',this).val(($quatity_num * 1) * ($rate_num * 1));
                              }
                              // else{
                              //   console.log("else");
                              //   $total = 0;
                              // }
                              $('.multTotal',this).val($total).text($total);
                                mult += $total;
                            });
                            $("#subtotal").val(mult).text(mult);

                            var $subtotal = mult;
                            var $total_discount_amount = $('.total_discount_amount').val();
                            var $total_discount_type = $('.total_discount_type').val();
                            if($total_discount_type != ''){
                              $total_discount_amount = ($total_discount_amount != '')?$total_discount_amount:0;
                            }

                            if ($total_discount_type == 1) {
                              if($total_discount_amount != ''){
                                if ($total_discount_amount <= 100) {
                                  $total_discount_amount = ($total_discount_amount / 100) * $subtotal;
                                }else{

                                  $total_discount_amount = $subtotal;
                                  $('.total_discount_amount').val(100);
                                  // return false;
                                }
                              }
                            }else if ($total_discount_type == 2){
                              if($total_discount_amount != ''){
                                $total_discount_amount = $total_discount_amount;
                              }
                            }else{
                              $('.total_discount_amount').val(0);
                              $total_discount_amount = 0;
                            }

                            var $grandtotal = $subtotal - $total_discount_amount;

                            if($grandtotal < 0){
                              $grandtotal = 0;
                              $('.total_discount_amount').val($subtotal);
                            }
                            $('#grandtotal').val($grandtotal).text($grandtotal);
                        }

                        if (data['redirect'] !== undefined)
                        {
                            setTimeout(function(){
                                window.location = data['redirect'];
                            },1500);
                        }
                        if (data['deleteRow'] !== undefined)
                        {
                            $(ele).closest("tr").remove();
                            $(ele).closest("tr").css("display",'none');
                            
                        }
                        if (data['reload'] !== undefined)
                        {
                            window.location.reload(true);
                        }
                        if (data['fieldsEmpty'] == 'yes'){

                            resetForm();

                        }
                    }
                });
            }
            else{$("#loader").hide();}
        }
        else
        {
            alert(href);
            $.ajax({
                url: href,
                dataType: "json",
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $("#loader").hide();
                    $("button[type=submit]").removeAttr("disabled");
                    error("Request not completed.Please try Again");
                },
                success: function(data) {
                    $("#loader").hide();
                    $("button[type=submit]").removeAttr("disabled");
                    if (data == null || data == "")
                    {
                        window.location.reload(true);
                    }
                    if (data['error'] !== undefined)
                    {
                        error(data['error']);
                        $("button[type=submit]").removeAttr("disabled");
                    }
                    if (data['success'] !== undefined)
                    {
                        $("button[type=submit]").removeAttr("disabled");
                        success(data['success']);
                    }
                    if (data['redirect'] !== undefined)
                    {
                        $("button[type=submit]").removeAttr("disabled");
                        setTimeout(function(){
                            window.location = data['redirect'];
                        },1500);
                    }
                    if (data['deleteRow'] !== undefined)
                    {
                        $("button[type=submit]").removeAttr("disabled");
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                    }
                    if (data['detailsDelete'] !== undefined)
                    {
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                        
                    }
                    if (data['reload'] !== undefined)
                    {
                        window.location.reload(true);
                    }
                    if (data['fieldsEmpty'] == 'yes'){

                        resetForm();

                    }
                }
            });
        }
        return false;
    });

    $("#example3,#invoice_data_table").on("click", ".ajax", function(event){
        event.preventDefault();
        $("#loader").show();
        $("button[type=button]").attr("disabled",'disabled');
        $("button[type=submit]").attr("disabled",'disabled');
        href = $(this).attr("href");
        rel = $(this).attr("rel");
        ele=$(this);
        if (rel === "delete")
        {
            var r = confirm("Do you want to perform this action?");
            if (r === true)
            {
                $.ajax({
                    url: href,
                    dataType: "json",
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $("#loader").hide();
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        error("Request not completed.Please try Again");
                    },
                    success: function(data) {
                        $("#loader").hide();
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        if (data == null || data == "")
                        {
                            window.location.reload(true);
                        }
                        if (data['error'] !== undefined)
                        {
                            error(data['error']);
                        }
                        if (data['success'] !== undefined)
                        {
                            success(data['success']);
                        }
                        if(data['details']){
                            $(ele).parent("tr").parent().parent().remove();
                            $(ele).parent("div").parent().parent().remove();
                        }
                        if (data['redirect'] !== undefined)
                        {
                            setTimeout(function(){
                                window.location = data['redirect'];
                            },1500);
                        }
                        if (data['deleteRow'] !== undefined)
                        {
                            $(ele).closest("tr").remove();
                            $(ele).closest("tr").css("display",'none');
                            
                        }
                        if (data['reload'] !== undefined)
                        {
                            window.location.reload(true);
                        }
                        if (data['fieldsEmpty'] == 'yes'){

                            resetForm();

                        }
                    }
                });
            }
            else{$("#loader").hide();}
        }
        else
        {
            alert(href);
            $.ajax({
                url: href,
                dataType: "json",
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $("#loader").hide();
                    $("button[type=button]").removeAttr("disabled");
                    $("button[type=submit]").removeAttr("disabled");
                    error("Request not completed.Please try Again");
                },
                success: function(data) {
                    $("#loader").hide();
                    $("button[type=button]").removeAttr("disabled");
                    $("button[type=submit]").removeAttr("disabled");
                    if (data == null || data == "")
                    {
                        window.location.reload(true);
                    }
                    if (data['error'] !== undefined)
                    {
                        error(data['error']);
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                    }
                    if (data['success'] !== undefined)
                    {
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        success(data['success']);
                    }
                    if (data['redirect'] !== undefined)
                    {
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        setTimeout(function(){
                            window.location = data['redirect'];
                        },1500);
                    }
                    if (data['deleteRow'] !== undefined)
                    {
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                    }
                    if (data['reload'] !== undefined)
                    {
                        window.location.reload(true);
                    }
                    if (data['fieldsEmpty'] == 'yes'){

                        resetForm();

                    }
                }
            });
        }
        return false;
    });

    $(".ajaxNotable").click(function() {
        $("#loader").show();
        $("button[type=button]").attr("disabled",'disabled');
        $("button[type=submit]").attr("disabled",'disabled');
        href = $(this).attr("href");
        rel = $(this).attr("rel");
        ele=$(this);
        if (rel === "delete")
        {
            var r = confirm("Do you want to perform this action?");
            if (r === true)
            {
                $.ajax({
                    url: href,
                    dataType: "json",
                    error: function(jqXHR, textStatus, errorThrown)
                    {
                        $("#loader").hide();
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        error("Request not completed.Please try Again");
                    },
                    success: function(data) {
                        $("#loader").hide();
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        if (data == null || data == "")
                        {
                            window.location.reload(true);
                        }
                        if (data['error'] !== undefined)
                        {
                            error(data['error']);
                        }
                        if (data['success'] !== undefined)
                        {
                            success(data['success']);
                        }
                        if(data['details']){
                            $(ele).parent("tr").remove();
                            $(ele).parent('div').remove();
                        }
                        if (data['redirect'] !== undefined)
                        {
                            setTimeout(function(){
                                window.location = data['redirect'];
                            },1500);
                        }
                        if (data['deleteRow'] !== undefined)
                        {
                            $(ele).closest("tr").remove();
                            $(ele).closest("tr").css("display",'none');
                            
                        }
                        if (data['reload'] !== undefined)
                        {
                            window.location.reload(true);
                        }
                        if (data['fieldsEmpty'] == 'yes'){

                            resetForm();

                        }
                    }
                });
            }
            else{$("#loader").hide();}
        }
        else
        {
            alert(href);
            $.ajax({
                url: href,
                dataType: "json",
                error: function(jqXHR, textStatus, errorThrown)
                {
                    $("#loader").hide();
                    $("button[type=button]").removeAttr("disabled");
                    $("button[type=submit]").removeAttr("disabled");
                    error("Request not completed.Please try Again");
                },
                success: function(data) {
                    $("#loader").hide();
                    $("button[type=submit]").removeAttr("disabled");
                    if (data == null || data == "")
                    {
                        window.location.reload(true);
                    }
                    if (data['error'] !== undefined)
                    {
                        error(data['error']);
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                    }
                    if (data['success'] !== undefined)
                    {
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        success(data['success']);
                    }
                    if (data['redirect'] !== undefined)
                    {
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        setTimeout(function(){
                            window.location = data['redirect'];
                        },1500);
                    }
                    if (data['deleteRow'] !== undefined)
                    {
                        $("button[type=button]").removeAttr("disabled");
                        $("button[type=submit]").removeAttr("disabled");
                        $(ele).closest("tr").remove();
                        $(ele).closest("tr").css("display",'none');
                    }
                    if (data['reload'] !== undefined)
                    {
                        window.location.reload(true);
                    }
                    if (data['fieldsEmpty'] == 'yes'){

                        resetForm();

                    }
                }
            });
        }
        return false;
    });

    // $(".date").datepicker(
    //         {
    //             changeMonth: true,
    //             changeYear: true,
    //             dateFormat: "yy-mm-dd"
    //         });
    /*$('.time').timepicker({
     timeFormat: "hh:mm tt"
     });*/
    $(".ajaxselect").change(function(){
        surl=$(this).attr("data-url");
        target_id=$(this).attr("data-target");
        val=$(this).val();
        $.ajax({
            url:surl+"/"+val,
            success:function(data)
            {
                $("#"+target_id).html(data);
            }
        });
    });
    if($.fn.select2)
    {
    $(".select2").select2();
}
}

function setSelected(id, value)
{
    $("#" + id + " option").each(function() {
        val = $(this).val();
        if (value == val)
        {
            $(this).attr("selected", "selected");
        }

    });
}
function deleteP(url)
{
    var r = confirm("Would you like to delete?")
    if (r == true)
    {
        window.location = url;
    }
}

function error(message)
{
    delay(200, function() {
        return toastr.error(message, 'Error');
    });
}
function success(message)
{
    delay(200, function() {
        return toastr.success(message, 'Success');
    });
}

function Removediv(val)
{
    $(val).parent().parent().parent().remove();
}
function resetForm()
{

    $("form input[type=text]").val("");

    $("form input[type=password]").val("");

    $("form input[type=email]").val("");

    $("form input[type=color]").val("");

    $("form input[type=date]").val("");

    $("form input[type=datetime-local]").val("");

    $("form input[type=file]").val("");

    $("form input[type=image]").val("");

    $("form input[type=month]").val("");

    $("form input[type=number]").val("");

    $("form input[type=range]").val("");

    $("form input[type=tel]").val("");

    $("form input[type=url]").val("");

    $("form input[type=week]").val("");

    $("form select").val("");

    $("form textarea").val("");

}
function ajaxRequest(href)
{
    $.ajax({
        url: href,
        dataType: "json",
        error: function(jqXHR, textStatus, errorThrown)
        {
            $("#loader").hide();
            error("Request not completed.Please try Again");
        },
        success: function(data) {
            $("#loader").hide();
            if (data == null || data == "")
            {
                window.location.reload(true);
            }
            if (data['error'] !== undefined)
            {
                error(data['error']);
            }
            if (data['success'] !== undefined)
            {
                success(data['success']);
            }
            if (data['redirect'] !== undefined)
            {
                window.location = data['redirect'];
            }
            if (data['deleteRow'] !== undefined)
            {
                $("button[type=button]").removeAttr("disabled");
                $("button[type=submit]").removeAttr("disabled");
                $(ele).closest("tr").remove();
                $(ele).closest("tr").css("display",'none');
            }
        }
    });
}
$(document).ready(function() {
    var form = $('.ajaxForm'),
    original = form.serialize()

    form.submit(function(){
      window.onbeforeunload = null
    })

    window.onbeforeunload = function(){
      if (form.serialize() != original)
        return 'Are you sure you want to leave?'
    }

    initComp();
});