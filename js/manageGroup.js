
var manageGroupModal = $("#modalManageGroup");

$('.manageGroupBtn').on('click', function (e) {

    // stop propagation and prevent default
    e.preventDefault();
    e.stopPropagation();

    var dnGroup = $(this).data('dn');

    console.log(dnGroup);

    $.post('parts/externals/getGroup.php', {'dn': dnGroup}).done(function (group) {

        console.log(group);

        $.get('parts/externals/getUsers.php').done(function (users) {

            // update modal display
            var modalTitle = manageGroupModal.find('.modal-title');

            modalTitle.empty();
            modalTitle.append('Manage group : <strong>' + group.name + '</strong>');

            var table = '<table class="table">';

            table += '<thead>';
            table += '<th scope="col">#</th>';
            table += '<th scope="col">uid</th>';
            table += '<th scope="col">Surname</th>';
            table += '<th scope="col">Name</th>';
            table += '<th scope="col"></th>';

            table += '<tbody>';

            var counter = 1;
            var groupsUids = group.memberUid;

            users.forEach(function(user){
                table += '<tr>';
                table += '<td>' + (counter++) + '</td>';
                table += '<td>' + user.uid + '</td>';
                table += '<td>' + user.surname + '</td>';
                table += '<td>' + user.name + '</td>';
                table += '<td>';

                // add actions buttons
                if(groupsUids.indexOf(user.uid) != -1){
                    table += '<button class="btn btn-danger manage-user-group" data-dn="' + group.dn + '" data-uid="' + user.uid + '">Detach</button>';
                }else{
                    table += '<button class="btn btn-info manage-user-group" data-dn="' + group.dn + '" data-uid="' + user.uid + '">Attach</button>';
                }

                table += '</td>';
                table += '</tr>';
            });

            table += '</tbody>';

            var modalBody = manageGroupModal.find('.modal-body');

            modalBody.empty();
            modalBody.append(table);

            // unbind and update click events on new DOM elements
            $('.manage-user-group').unbind( "click" );
            $('.manage-user-group').on('click',  function (e) {
                attachDetachCallback(e);
            });
        });
    });

    // display modal
    manageGroupModal.modal('show');
});


// Attach and detach actions of user to group
function attachDetachCallback(e) {

    e.preventDefault();
    e.stopPropagation();

    var btn = $(e.target);
    var dn = btn.data('dn');
    var uid = btn.data('uid');

    console.log(dn + " " + uid);

    if (btn.hasClass('btn-danger')) {

        $.post('parts/externals/delUserOfGroup.php', {'dn': dn, 'uid': uid});

        btn.removeClass('btn-danger');
        btn.addClass('btn-info');
        btn.text("Attach");

    } else if (btn.hasClass('btn-info')) {

        $.post('parts/externals/addUserToGroup.php', {'dn': dn, 'uid': uid});

        btn.removeClass('btn-info');
        btn.addClass('btn-danger');
        btn.text("Detach");
    }
};

