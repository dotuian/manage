<tr>
    <td class="center">
        <?php 
            if(in_array('teacher/update', $this->authoritys)) {
                echo "<a href='{$this->createUrl('teacher/update', array('ID' => $data['ID']))}'>{$data['name']}</a>";
            } else {
                echo $data['name']; 
            }
        ?>
    </td>
    <td class="center"><?php echo $data['sex'] === 'M' ? '男' : '女'; ?></td>
    <td class="center"><?php echo $data['birthday']; ?></td>
    <td class="center"><?php echo $data['teach_subjects']; ?></td>
    <td class="center autohide"><?php echo $data['id_card_no']; ?></td>
    <td class="autohide"><?php echo $data['home_address']; ?></td>
    <td class="center autohide"><?php echo $data['telephone']; ?></td>
    
    <td class="center">
        <span class="label <?php echo $data['status'] === '1' ? 'label-active' : 'label-stop';?>"><?php echo $data['status'] === '1' ? '在校' : '离校'; ?></span>
    </td>
</tr>
