$('#selectAllBoxes').click(function(event){
    if(this.checked){
        $('.checkBoxes').each(function(){
            this.checked = true;                  
        });
    }else{
        $('.checkBoxes').each(function(){
            this.checked = false;                  
        });                     
    } 
});


$(document).ready(function() {
    $('#addPost').bootstrapValidator({
        container: '#messages',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            title: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Title is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be less than 30 characters long'
                    },
                }
            },
            post_category_id: {
                validators: {
                    notEmpty: {
                        message: 'The email is required and cannot be empty'
                    },
                }
            },
            image: {
                message: 'No image is selected',
                validators: {
                    notEmpty: {
                        message: 'The Image is required and cannot be empty'
                    },
                }
            },
            post_tags: {
                message: 'The tags is not valid',
                validators: {
                    notEmpty: {
                        message: 'The Post tags is required and cannot be empty'
                    },
                    stringLength: {
                        max: 30,
                        message: 'The tags must be less than 30 characters long'
                    },
                }
            }            
        }
    });
});


function loadUsersOnline(){
    $.get("functions.php?onlineusers=result", function(data){
        $('.usersonline').text(data);
    });
}


setInterval(function(){
    loadUsersOnline();
}, 500);