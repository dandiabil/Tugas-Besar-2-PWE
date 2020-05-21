<body>
    
    <div class="container">
    <br>
        <center><h3>Data Mahasiswa</h3></center>

        <button type="button" class="btn btn-success btn-sm" onclick="add_data()"> Add Data</button>
        <button type="button" class="btn btn-info btn-sm" onclick="reload_table()"> Reload</button>
        <table id="table" class="table table-stripped table-bordered table-hover ">
        <br>
        <br>
            <thead class="thead-dark">
                <th>Nomor Mahasiswa</th>
                <th>Nama Mahasiswa</th>
                <th>Program Studi</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Nilai</th>
                <th>Opsi</th>
            </thead>
        </table>
        
        <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_form">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_mhs"/> 
                    <div class="row">
                        <div class="col-md-6">
                                <fieldset class="form-group">
                                <label class="form-label">Nomor Mahasiswa</label>
                                <input name="no_mhs" class="form-control form-control-blue-fill" type="text">
                                <font color="red"><span class="help-block"></span></font>
                                </fieldset>

                                <fieldset class="form-group">
                                <label class="form-label">Nama Mahasiswa</label>
                                <input name="nama_mhs"  class="form-control form-control-blue-fill" type="text">
                                <font color="red"><span class="help-block"></span></font>
                                </fieldset>

                                <fieldset class="form-group">
                                <label class="form-label">Program Studi</label>
                                <select name="prodi" class="form-control form-control-blue-fill">
                                    <option value="">- Program Studi -</option>
                                    <option value="Teknik Informasi">Teknik Informasi</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                </select>
                                <font color="red"><span class="help-block"></span></font>
                                </fieldset>
                        </div>

                        <div class="col-md-6">
                                
                                <fieldset class="form-group">
                                <label class="form-label">Tanggal Lahir</label>
                                <input name="tgl_lahir" class="form-control datepicker" type="text">
                                <font color="red"><span class="help-block"></span></font>
                                </fieldset>

                                <fieldset class="form-group">
                                <label class="form-label">Nilai</label>
                                <input name="nilai"  class="form-control form-control-blue-fill" type="text">
                                <font color="red"><span class="help-block"></span></font>
                                </fieldset>
                        </div>

                        <div class="col-md-12">
                                <fieldset class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control form-control-blue-fill"></textarea>
                                </fieldset>
                        </div>

                    </div><!--.row-->
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" onclick="save() " class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
        
    </div>

   
    <script type="text/javascript">
    var save_method; 
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 
            responsive: true,
            "processing": true, 
            "serverSide": true, 
            "order": [], 
            "ajax": {
                "url": "<?php echo site_url('mahasiswa/ajax_list')?>",
                "type": "POST"
            },

            "columnDefs": [{ 
                "targets": [ -1 ], 
                "orderable": false, 
            },
            ],
        });

    //datepicker
    $('.datepicker').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true 
    });

    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});


function add_data(){
    save_method = 'add';
    $('#form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $('#modal_form').modal('show'); 
    $('.modal-title').text('Add Data'); 
}

function edit_data(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('mahasiswa/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="id_mhs"]').val(data.id_mhs);
            $('[name="no_mhs"]').val(data.no_mhs);
            $('[name="nama_mhs"]').val(data.nama_mhs);
            $('[name="prodi"]').val(data.prodi);
            $('[name="alamat"]').val(data.alamat);
            $('[name="nilai"]').val(data.nilai);
            $('[name="tgl_lahir"]').val(data.tgl_lahir);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
            
        },      
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}

function reload_table(){
    table.ajax.reload(null,false); 
}

function save(){
    $('#btnSave').text('saving...'); 
    $('#btnSave').attr('disabled',true); 
    var url;
    if(save_method == 'add') {
    url = "<?php echo site_url('mahasiswa/ajax_add')?>";
    } else {
        url = "<?php echo site_url('mahasiswa/ajax_update')?>";
    }

    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data) {
            if(data.status){
                $('#modal_form').modal('hide');
                reload_table();
            }
            else {
                for (var i = 0; i < data.inputerror.length; i++) {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btnSave').text('save');
            $('#btnSave').attr('disabled',false); 
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('save'); 
            $('#btnSave').attr('disabled',false); 
        }
    });
}

function delete_data(id){
    if(confirm('Are you sure delete this data?')){
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('mahasiswa/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                $('#modal_form').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });
    }
}

</script>
<br><br>
</body>
</html>