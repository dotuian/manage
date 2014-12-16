<tr>
    <td class="center">
        <?php 
            if(in_array('role/update', $this->authoritys)) {
                echo "<a href='{$this->createUrl('role/update', array('ID' => $data['ID']))}'>{$data['role_name']}</a>";
            } else {
                echo $data['role_name']; 
            }
        ?>
    </td>
    <td class="center"><?php echo $data['create_time']; ?></td>
    <td class="center"><?php echo $data['update_time']; ?></td>
</tr>
