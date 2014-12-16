<tr>
    <td class="center">
        <?php 
            if (in_array('student/update', $this->authoritys)) {
                echo "<a href='{$this->createUrl('student/update', array('ID' => $data['ID']))}'>{$data['name']}</a>";
            } else {
                echo $data['name'];
            }
        ?>
    </td>
    <td class="center"><?php if($data['sex'] == 'M') echo '男' ; if($data['sex'] == 'F') echo '女'; ?></td>
    <td class="center"><?php echo $data['id_card_no']; ?></td>
    <td class="center"><?php echo $data['school_year']; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center">
        <span class="label <?php echo $data['status'] === '1' ? 'label-active' : 'label-stop';?>"><?php echo $data['status'] === '1' ? '在校' : '离校'; ?></span>
    </td>
</tr>