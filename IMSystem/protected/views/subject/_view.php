<tr>
    <td class="center"><?php echo $data['subject_code']; ?></td>
    <td class="center">
        <?php 
            if(in_array('subject/update', $this->authoritys)) {
                echo "<a href='{$this->createUrl('subject/update', array('ID' => $data['ID']))}'>{$data['subject_name']}</a>";
            } else {
                echo $data['subject_name']; 
            }
        ?>
    </td>
    <td class="center"><?php echo $data['subject_short_name']; ?></td>
    <td class="center"><?php echo isset($type[$data['subject_type']]) ? $type[$data['subject_type']] : ''; ?></td>
    <td class="center">
        <span class="label <?php echo $data['status'] === '1' ? 'label-active' : 'label-stop';?>"><?php echo $data['status'] === '1' ? '使用中' : '暂停中'; ?></span>
    </td>
</tr>