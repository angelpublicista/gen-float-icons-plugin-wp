<?php 
    global $wpdb;

    $tableIcons = "{$wpdb->prefix}gen_icons";
    if(isset($_POST['btnSave'])){
        $title = $_POST['title'];
        $link = $_POST['link'];
        
        $query = "SELECT IconId FROM $tableIcons ORDER BY IconId DESC limit 1";
        $res = $wpdb->get_results($query, ARRAY_A);
        $nextId = $res[0]['IconId'] + 1;
        $data = array(
            'IconId' => null,
            'title' => $title,
            'link' => $link
        );

        $response = $wpdb->insert($tableIcons, $data);
    }

    $query = "SELECT * FROM {$wpdb->prefix}gen_icons";
    $icons_list = $wpdb->get_results($query, ARRAY_A);

    if(empty($icons_list)){
        $icons_list = array();
    }
?>
<div class="wrap">
    <h1><?php echo get_admin_page_title(); ?></h1>
    <a href="#" class="btn btn-primary" style="margin: 10px 0; display: inline-block" data-toggle="modal" data-target="#gen-modal-new">Añadir nuevo icono</a>
    <table class="wp-list-table widefat fixed striped pages">
        <thead>
            <th><b>Título</b></th>
            <th><b>Link</b></th>
            <th><b>Acciones</b></th>
        </thead>
        <tbody id="gen-icon-list">
            <?php foreach($icons_list as $key => $value): ?>
            <tr>
                <td><?php echo $value['title']; ?></td>
                <td><?php echo $value['link']; ?></td>
                <td >
                   <a href="#" class="btn btn-primary">Editar</a> 
                   <a href="#" data-id="<?php echo $value['IconId'] ?>" class="btn btn-secondary btnDelete">Borrar</a> 
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="gen-modal-new" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Icono</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="post" id="form-new-item">
        <div class="modal-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Título</label>
                        <input name="title" type="text" class="form-control" placeholder="Ej: Facebook">
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Link</label>
                        <input name="link" type="text" class="form-control" placeholder="Ej: https://facebook.com">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="" style="display: block">Color Fondo</label>
                        <input name="bgColor" id="bgColor" type="text" class="color-field">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="" style="display: block">Color Fondo Hover</label>
                        <input name="bgColorHover" id="bgColorHover" type="text" class="color-field">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                        <label for="" style="display: block">Estilo</label>
                        <select class="form-control custom-select" name="styleIcon" id="styleIcon">
                            <option selected disabled> Selecciona uno</option>
                            <option value="circle">Circular</option>
                            <option value="rounded">Redondeado</option>
                            <option value="squared">Cuadrado</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" style="display: block">Icono</label>
                        <select class="form-control custom-select" name="styleIcon" id="styleIcon">
                            <option selected value="faIcon">Font awesome</option>
                            <option value="customIcon">Personalizado</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="">Icono Font Awesome</label>
                        <input name="faIcon" type="text" class="form-control" placeholder="Ej: fab fa-instagram">
                        <small><i>Ver <a href="https://fontawesome.com/" target="_blank">Font Awesome</a></i></small>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" style="display: block">Color Icono</label>
                        <input name="iconColor" id="iconColor" type="text" class="color-field">
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="" style="display: block">Color Icono Hover</label>
                        <input name="iconColorHover" id="iconColorHover" type="text" class="color-field">
                    </div>
                </div>
                
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" id="btnSave" name="btnSave">Guardar</button>
        </div>
      </form>
      
    </div>
  </div>
</div>