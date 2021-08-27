<script type="text/javascript">

    $(document).ready( function () {

        $('#<?php echo $table_id ?>').DataTable({

            language: {
                processing:     "<?php echo lang('DataTables.processing') ?>",
                search:         "<?php echo lang('DataTables.search') ?>&nbsp;:",
                lengthMenu:     "<?php echo lang('DataTables.lengthMenu') ?>",
                info:           "<?php echo lang('DataTables.info') ?>",
                infoEmpty:      "<?php echo lang('DataTables.infoEmpty') ?>",
                infoFiltered:   "<?php echo lang('DataTables.infoFiltered') ?>",
                infoPostFix:    "<?php echo lang('DataTables.infoPostFix') ?>",
                loadingRecords: "<?php echo lang('DataTables.loadingRecords') ?>",
                zeroRecords:    "<?php echo lang('DataTables.zeroRecords') ?>",
                emptyTable:     "<?php echo lang('DataTables.emptyTable') ?>",
                paginate: {
                    first:      "<?php echo lang('DataTables.pag_first') ?>",
                    previous:   "<?php echo lang('DataTables.pag_previous') ?>",
                    next:       "<?php echo lang('DataTables.pag_next') ?>",
                    last:       "<?php echo lang('DataTables.pag_last') ?>"
                },
                aria: {
                    sortAscending:  ": <?php echo lang('DataTables.sortAscending') ?>",
                    sortDescending: ": <?php echo lang('DataTables.sortDescending') ?>"
                }
            },

            order: [[ 0, "desc" ]],
            processing: true,
            serverSide: true,
            ajax: '<?php echo $controller_json;?>'
        });


    } );


</script>