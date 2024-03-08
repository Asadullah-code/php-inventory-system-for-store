var manageProductTable;

$(document).ready(function() {
	// top nav bar 
	$('#navProduct').addClass('active');
	// manage product data table
	manageProductTable = $('#manageProductTable').DataTable({
		'ajax': 'php_action/fetchProduct.php',
		'order': []
	});

	// add product modal btn clicked
	$("#addProductModalBtn").unbind('click').bind('click', function() {
		// // product form reset
		$("#submitProductForm")[0].reset();		

		// remove text-error 
		$(".text-danger").remove();
		// remove from-group error
		$(".form-group").removeClass('has-error').removeClass('has-success');

		$("#productImage").fileinput({
	      overwriteInitial: true,
		    maxFileSize: 2500,
		    showClose: false,
		    showCaption: false,
		    browseLabel: '',
		    removeLabel: '',
		    browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
		    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
		    removeTitle: 'Cancel or reset changes',
		    elErrorContainer: '#kv-avatar-errors-1',
		    msgErrorClass: 'alert alert-block alert-danger',
		    defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
		    layoutTemplates: {main2: '{preview} {remove} {browse}'},								    
	  		allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
			});   

		// submit product form
		$("#submitProductForm").unbind('submit').bind('submit', function() {

			// form validation
			var productDate = $("#productDate").val();
			var productName = $("#productName").val();
			var quantity = $("#quantity").val();
			var Retail Price = $("#rate").val();
			var wholesale = $("#wholesale").val();
			var thb = $("#thb").val();
			var productStatus = $("#productStatus").val();

			if(productDate == "") {
				$("#productDate").after('<p class="text-danger">Product date field is required</p>');
				$('#productDate').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productDate").find('.text-danger').remove();
				// success out for form 
				$("#productDate").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(productName == "") {
				$("#productName").after('<p class="text-danger">Product Name field is required</p>');
				$('#productName').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productName").find('.text-danger').remove();
				// success out for form 
				$("#productName").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(quantity == "") {
				$("#quantity").after('<p class="text-danger">Quantity field is required</p>');
				$('#quantity').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#quantity").find('.text-danger').remove();
				// success out for form 
				$("#quantity").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(rate == "") {
				$("#rate").after('<p class="text-danger">Rate field is required</p>');
				$('#rate').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#rate").find('.text-danger').remove();
				// success out for form 
				$("#rate").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(wholesale == "") {
				$("#wholesale").after('<p class="text-danger">wholesale field is required</p>');
				$('#wholesale').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#wholesale").find('.text-danger').remove();
				// success out for form 
				$("#wholesale").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(thb == "") {
				$("#thb").after('<p class="text-danger">thb field is required</p>');
				$('#thb').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#thb").find('.text-danger').remove();
				// success out for form 
				$("#thb").closest('.form-group').addClass('has-success');	  	
			}	// /else


			if(productStatus == "") {
				$("#productStatus").after('<p class="text-danger">Product Status field is required</p>');
				$('#productStatus').closest('.form-group').addClass('has-error');
			}	else {
				// remov error text field
				$("#productStatus").find('.text-danger').remove();
				// success out for form 
				$("#productStatus").closest('.form-group').addClass('has-success');	  	
			}	// /else

			if(productDate && productName && quantity && rate && wholesale && thb && productStatus) {
				// submit loading button
				$("#createProductBtn").button('loading');

				var form = $(this);
				var formData = new FormData(this);

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: formData,
					dataType: 'json',
					cache: false,
					contentType: false,
					processData: false,
					success:function(response) {

						if(response.success == true) {
							// submit loading button
							$("#createProductBtn").button('reset');
							
							$("#submitProductForm")[0].reset();

							$("html, body, div.modal, div.modal-content, div.modal-body").animate({scrollTop: '0'}, 100);
																	
							// shows a successful message after operation
							$('#add-product-messages').html('<div class="alert alert-success">'+
		            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
		            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
		          '</div>');

							// remove the mesages
		          $(".alert-success").delay(500).show(10, function() {
								$(this).delay(3000).hide(10, function() {
									$(this).remove();
								});
							}); // /.alert

		          // reload the manage student table
							manageProductTable.ajax.reload(null, true);

							// remove text-error 
							$(".text-danger").remove();
							// remove from-group error
							$(".form-group").removeClass('has-error').removeClass('has-success');

						} // /if response.success
						
					} // /success function
				}); // /ajax function
			}	 // /if validation is ok 					

			return false;
		}); // /submit product form

	}); // /add product modal btn clicked
	

	// remove product 	

}); // document.ready fucntion

function editProduct(productId = null) {
    if (productId) {
        $("#productId").remove();
        // remove text-error
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');
        // modal spinner
        $('.div-loading').removeClass('div-hide');
        // modal div
        $('.div-result').addClass('div-hide');

        $.ajax({
            url: 'php_action/fetchSelectedProduct.php',
            type: 'post',
            data: { productId: productId },
            dataType: 'json',
            success: function (response) {
                // modal spinner
                $('.div-loading').addClass('div-hide');
                // modal div
                $('.div-result').removeClass('div-hide');

                // product id
                $(".editProductFooter").append('<input type="hidden" name="productId" id="productId" value="' + response.product_id + '" />');

                // product date
                $("#editProductDate").val(response.product_date);
                // product name
                $("#editProductName").val(response.product_name);
                // quantity
                $("#editQuantity").val(response.quantity);
                // rate
                $("#editRate").val(response.rate);
                // brand name
                $("#editWholesale").val(response.wholesale);
                // category name
                $("#editThb").val(response.thb);
                // status
                $("#editProductStatus").val(response.active);

                // update the product data function
                $("#editProductForm").unbind('submit').bind('submit', function () {
                    // form validation
                    var productDate = $("#editProductDate").val();
                    var productName = $("#editProductName").val();
                    var quantity = $("#editQuantity").val();
                    var rate = $("#editRate").val();
                    var wholesale = $("#editWholesale").val();
                    var thb = $("#editThb").val();
                    var productStatus = $("#editProductStatus").val();

                    if (productDate == "") {
                        $("#editProductDate").after('<p class="text-danger">Product Date field is required</p>');
                        $('#editProductDate').closest('.form-group').addClass('has-error');
                    } else {
                        // remove error text field
                        $("#editProductDate").find('.text-danger').remove();
                        // success out for form
                        $("#editProductDate").closest('.form-group').addClass('has-success');
                    } // /else

                    // Add similar validations for other fields...

                    if (productDate && productName && quantity && rate && wholesale && thb && productStatus) {
                        // submit loading button
                        $("#editProductBtn").button('loading');

                        var form = $(this);
                        var formData = new FormData(this);

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log(response);
                                if (response.success == true) {
                                    // submit loading button
                                    $("#editProductBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({ scrollTop: '0' }, 100);

                                    // shows a successful message after operation
                                    $('#edit-product-messages').html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                    // remove the messages
                                    $(".alert-success").delay(500).show(10, function () {
                                        $(this).delay(3000).hide(10, function () {
                                            $(this).remove();
                                        });
                                    }); // /.alert

                                    // reload the manage student table
                                    manageProductTable.ajax.reload(null, true);

                                    // remove text-error
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group").removeClass('has-error').removeClass('has-success');
                                } // /if response.success
                            } // /success function
                        }); // /ajax function
                    } // /if validation is ok

                    return false;
                }); // update the product data function
            } // /success function
        }); // /ajax to fetch product data
    } else {
        alert('Error: Please refresh the page.');
    }
} // /edit product function


function removeProduct(productId = null) {
    if (productId) {
        var removeButton = $("#removeProductBtn");

        // Disable the remove button and show a loading state
        removeButton.button('loading');

        $.ajax({
            url: 'php_action/removeProduct.php',
            type: 'post',
            data: { productId: productId },
            dataType: 'json',
            success: function(response) {
                // Reset the remove button to its original state
                removeButton.button('reset');

                if (response.success) {
                    // If the removal was successful:

                    // Hide the remove product modal
                    $("#removeProductModal").modal('hide');

                    // Update the product table using DataTable
                    updateProductTable();

                    // Show a success message
                    showMessage('success', response.messages);
                } else {
                    // If the removal was not successful, show an error message
                    showMessage('danger', response.messages);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                // Handle AJAX request failure
                removeButton.button('reset');
                console.error('Ajax request failed');
                console.error(xhr);
                console.error(textStatus);
                console.error(errorThrown);
                showMessage('danger', 'An error occurred during the request.');
            }
        });
    }
}

function updateProductTable() {
    // Check if DataTable is initialized
    if ($.fn.DataTable.isDataTable('#manageProductTable')) {
        // If initialized, reload the DataTable without a page refresh
        $('#manageProductTable').DataTable().ajax.reload(null, false);
    }
}

function showMessage(type, message) {
    var messagesContainer = $(".remove-messages");

    // Create an alert div based on the message type
    messagesContainer.html('<div class="alert alert-' + type + '">' +
        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
        '<strong><i class="glyphicon glyphicon-' + (type === 'success' ? 'ok-sign' : 'remove-sign') + '"></i></strong> ' + message +
        '</div>');

    // Show the message, delay for a few seconds, and then hide it
    messagesContainer.delay(500).show(10, function() {
        $(this).delay(3000).hide(10, function() {
            $(this).empty(); // Clear the message container
        });
    });
}


function clearForm(oForm) {
	// var frm_elements = oForm.elements;									
	// console.log(frm_elements);
	// 	for(i=0;i<frm_elements.length;i++) {
	// 		field_type = frm_elements[i].type.toLowerCase();									
	// 		switch (field_type) {
	// 	    case "text":
	// 	    case "password":
	// 	    case "textarea":
	// 	    case "hidden":
	// 	    case "select-one":	    
	// 	      frm_elements[i].value = "";
	// 	      break;
	// 	    case "radio":
	// 	    case "checkbox":	    
	// 	      if (frm_elements[i].checked)
	// 	      {
	// 	          frm_elements[i].checked = false;
	// 	      }
	// 	      break;
	// 	    case "file": 
	// 	    	if(frm_elements[i].options) {
	// 	    		frm_elements[i].options= false;
	// 	    	}
	// 	    default:
	// 	        break;
	//     } // /switch
	// 	} // for
}