$(document).ready(function () {
    const path =  "";
    // const path =  window.location.origin;

    // alert(path);
    // alert(path2);

    //Ajax for creation of TODOS and edit, to get display live.

    $('#submit').click(function (e) {
        //New todoDiv creation
        e.preventDefault();
        var url = path + "store";
        $.ajax({
            type: "POST",
            url: url,
            data: {title: $('#title').val(), todo: $('#todo').val()},
            success: function (response) {
                var obj = JSON.parse(response);
                var html = [
                    '<div class="card col-sm-10 col-md-5 col-lg-5 m-1 width-cards" id="divCard'+ obj.id +'">',
                    '<div class="card-body">',
                    '<h4 class="card-title titles" id="title' + obj.id + '">' + obj.title + '</h4>',
                    '<input id="titleEdit' + obj.id + '"' +
                    ' value="' + obj.title + '"' +
                    ' type="text" class="display" name="titleEdit">',
                    '<p class="d-block edit-todo card-text" id="todo' + obj.id + '">' + obj.todo + '</p>',
                    '<textarea id="todoEdit' + obj.id +'"' +
                    ' rows="6"' +
                    ' class="w-100 display"' +
                    ' name="todoEdit"> ' + obj.todo +
                    ' </textarea>',
                    '<input id="submitEdit' + obj.id +'"' +
                    '  class="submit-changes display"' +
                    '  value="submit"' +
                    '  type="submit"' +
                    '  name="submitEdit' + obj.id + '">',
                    '<a class="card-link edit bg-warning text-white rounded p-1 ml-2" href="" id="' + obj.id + '"' + '>Edit</a>',
                    '<a class="card-link bg-success text-white rounded p-1 ml-2 completed" href="" id="' + obj.id + '"' + '>Complete</a>',
                    '</div>',
                    '</div>'
                ].join("\n");
                $("#displayTodos").append(html);

                //Passing the click function for new todoDiv creation
                $('.edit').click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    var editTitle = $('#titleEdit' + id);
                    var editTodo = $('#todoEdit' + id);
                    var submitChanges = $('#submitEdit' + id);
                    editTitle.show();
                    editTodo.show();
                    submitChanges.show();
                });
                $('.submit-changes').click(function (e) {
                    e.preventDefault();
                    var selector = $(this).attr('name');
                    var id = selector.replace("submitEdit", "");
                    var url = path + "edit";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {title: $('#titleEdit' + id).val(), todo: $('#todoEdit' + id).val(), id: id},
                        success: function (response) {
                            var obj = JSON.parse(response);
                            var todoChange = $('#todo' + id);
                            var titleChange = $('#title' + id);
                            $('#todoEdit' + id).hide();
                            $('#titleEdit' + id).hide();
                            $('#submitEdit' + id).hide();
                            $(this).hide();
                            todoChange.html(obj.todo);
                            titleChange.html(obj.title);
                        }
                    })
                });

                //For new todoDiv to move to completed directly
                $('.completed').click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr('id');
                    var url = path + "completed/" + id;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {id: id},
                        success: function (response) {
                            var obj = JSON.parse(response);
                            var html = [
                                '<div id="completed' + obj.id + '" class="w-50">',
                                '<div class="card m-1 colorCompleted remove">',
                                '<div class="card-body">',
                                '<h4 class="card-subtitle mb-2">Completed</h4>',
                                '<h4 class="card-title titles" id="title' + obj.id + '">' + obj.title + '</h4>',
                                '<p class="d-block edit-todo card-text" id="todo' + obj.id + '">' + obj.todo + '</p>',
                                '<div class="bg-dark p-1 text-center rounded">',
                                '<a href="" class="text-white bg-dark delete" id="delete'+ obj.id +'">Remove</a>',
                                '</div>',
                                '</div>',
                                '</div>',
                                '</div>'
                            ].join("\n");
                            $("#completedTodos").append(html);
                            $("#divCard" + id).hide();
                        }
                    })
                });

                // Remove from Completed and DB
                $('.delete').click(function (e) {
                    e.preventDefault()
                    var selector = $(this).attr('id');
                    var id = selector.replace("delete", "");
                    alert(id);
                    var url = path + "delete/" + id;
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {id: id},
                        success: function (response) {
                            console.log(response);
                            $('#completed' + id).remove();
                        }
                    })
                })

            }
        });

    });


    //
    //
    // -----
    // CONTENT ALREADY ON PAGE TO GET UPDATED
    // SEPARATION BLOCK
    //Function block for TODOS already created

    //Edit block to show the new inputs
    $('.edit').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var editTitle = $('#titleEdit' + id);
        var editTodo = $('#todoEdit' + id);
        var submitChanges = $('#submitEdit' + id);
        editTitle.show();
        editTodo.show();
        submitChanges.show();
    });

    //To submit the inputs to edit method and update data with ajax
    $('.submit-changes').click(function (e) {
        e.preventDefault();
        var selector = $(this).attr('name');
        var id = selector.replace("submitEdit", "");
        var url = path + "edit";
        $.ajax({
            type: "POST",
            url: url,
            data: {title: $('#titleEdit' + id).val(), todo: $('#todoEdit' + id).val(), id: id},
            success: function (response) {
                var obj = JSON.parse(response);
                var todoChange = $('#todo' + id);
                var titleChange = $('#title' + id);
                $('#todoEdit' + id).hide();
                $('#titleEdit' + id).hide();
                $('#submitEdit' + id).hide();
                $(this).hide();
                todoChange.html(obj.todo);
                titleChange.html(obj.title);
            }
        })
    });

    //Completed todos, ajax place them on completed todos and hide from current todos
    $('.completed').click(function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var url = path + "completed/" + id;
        $.ajax({
            type: "POST",
            url: url,
            data: {id: id},
            success: function (response) {
                var obj = JSON.parse(response);
                var html = [
                    '<div id="completed' + obj.id + '" class="w-100">',
                    '<div class="card col-sm-10 col-md-4 col-lg-4 m-1 width-cards colorCompleted">',
                    '<div class="card-body">',
                    '<h4 class="card-subtitle mb-2 text-muted">Completed</h4>',
                    '<h4 class="card-title titles" id="title' + obj.id + '">' + obj.title + '</h4>',
                    '<p class="d-block edit-todo card-text" id="todo' + obj.id + '">' + obj.todo + '</p>',
                    '<div class="bg-dark p-1 text-center rounded">',
                    '<a href="" class="text-white bg-dark delete" id="delete'+ obj.id +'">Remove</a>',
                    '</div>',
                    '</div>',
                    '</div>',
                    '</div>'
                ].join("\n");
                $("#completedTodos").append(html);
                $("#divCard" + id).hide();
            }
        })
    });

    // Remove from Completed and DB
    $('.delete').click(function (e) {
        e.preventDefault();
        var selector = $(this).attr('id');
        var id = selector.replace("delete", "");
        var url = path + "delete/" + id;
        $.ajax({
            type: "POST",
            url: url,
            data: {id: id},
            success: function (response) {
                console.log(response);
                $('#completed' + id).remove();
            }
        })
    })

    $('.add').click(function (e){
        e.preventDefault();
        var selector = $(this).attr('id');
        var id = selector.replace("addTodos", "");
        var url = path + "loadFile/" + id;
        alert(id);
        alert(url);
        $.ajax({
            type: "POST",
            url: url,
            data: {id: id},
            success: function (response) {
                console.log(response);
                var obj = JSON.parse(response);
                console.log(obj);

                // console.log('as');
                // $('#completed' + id).remove();
            }
        })
    });

    $('.main-container')

}); //Finish document ready
