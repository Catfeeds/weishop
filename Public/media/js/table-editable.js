var TableEditable = function () {

    return {

        //main function to initiate the module
        init: function () {
            function restoreRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);

                for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                    oTable.fnUpdate(aData[i], nRow, i, false);
                }

                oTable.fnDraw();
            }

            function editRow(oTable, nRow) {
                var aData = oTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                for (var i = 0; i < jqTds.length-2; i++) {
                    jqTds[i].innerHTML = '<input type="text" class="m-wrap small" value="' + aData[i] + '">';
                };
                jqTds[i].innerHTML = '<a class="edit" href="">保存</a>';
                i++
                jqTds[i].innerHTML = '<a class="cancel" href="">取消</a>';
            }

            function saveRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                for (var i = 0; i < jqInputs.length; i++) {
                      oTable.fnUpdate(jqInputs[i].value, nRow, i, false);
                };
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, i, false);
                i++
                oTable.fnUpdate('<a class="delete" href="">删除</a>', nRow, i, false);
                oTable.fnDraw();
            }

            function cancelEditRow(oTable, nRow) {
                var jqInputs = $('input', nRow);
                for (var i = 0; i < jqInputs.length; i++) {
                    oTable.fnUpdate(jqInputs[i].value, nRow, i, false);
                };
                oTable.fnUpdate('<a class="edit" href="">编辑</a>', nRow, i, false);
                oTable.fnDraw();
            }

            var oTable = $('#sample_editable_1').dataTable({
                "aLengthMenu": [
                    [5, 15, 20, -1],
                    [5, 15, 20, "All"] // change per page values here
                ],
                // set the initial value
                "iDisplayLength": 5,
                "sDom": "<'row-fluid'<'span6'l><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
                "sPaginationType": "bootstrap",
                "oLanguage": {
                    "sLengthMenu": "_MENU_ 条/每页",
                    "oPaginate": {
                        "sPrevious": "Prev",
                        "sNext": "Next"
                    }
                },
                "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [0]
                    }
                ]
            });

            jQuery('#sample_editable_1_wrapper .dataTables_filter input').addClass("m-wrap medium"); // modify table search input
            jQuery('#sample_editable_1_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
            var nEditing = null;
            $('#sample_editable_1_new').click(function (e) {
                e.preventDefault();
                var aiNew = oTable.fnAddData(['', '', '', '',
                        '<a class="edit" href="">Edit</a>', '<a class="cancel" data-mode="new" href="">Cancel</a>'
                ]);
                var nRow = oTable.fnGetNodes(aiNew[0]);
                editRow(oTable, nRow);
                nEditing = nRow;
            });

            $('#sample_editable_1 a.delete').live('click', function (e) {
               yyxcomfirm(function(){
                    e.preventDefault();
                    var nRow = $("#sample_editable_1 a.delete").parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                    var delete_url=$("#sample_editable_1 a.delete").attr("del");
                    alert(delete_url)
                    $.ajax({
                    type:'GET',
                    url: delete_url,
                    success:function(red){
                        alert(red)
                    }
                    })
                },e) 
            });

            $('#sample_editable_1 a.cancel').live('click', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    oTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(oTable, nEditing);
                    nEditing = null;
                }
            });

            $('#sample_editable_1 a.edit').live('click', function (e) {
                e.preventDefault();
                /* Get the row as a parent of the link that was clicked on */
                var nRow = $(this).parents('tr')[0];

                if (nEditing !== null && nEditing != nRow) {
                    /* Currently editing - but not this row - restore the old before continuing to edit mode */
                    restoreRow(oTable, nEditing);
                    editRow(oTable, nRow);
                    nEditing = nRow;
                } else if (nEditing == nRow && this.innerHTML == "保存") {
                    /* Editing this row and want to save it */
                    saveRow(oTable, nEditing);
                    
                    nEditing = null;
                    alert("Updated! Do not forget to do some ajax to sync with backend :)");
                } else {
                    /* No edit in progress - let's start one */
                    editRow(oTable, nRow);
                    nEditing = nRow;
                }
            });
        }

    };

}();