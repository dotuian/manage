<tr>
    <td class="center"><?php echo $data['class_code']; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php if($data['class_type'] ==='0') echo '综合' ; if($data['class_type'] ==='1') echo '文科' ; if($data['class_type'] ==='2') echo '理科' ;; ?></td>
    <td class="center"><?php echo $data['status'] === '1' ? '在校' : '毕业'; ?></td>
    <td class="center"><?php echo $data['term_year']; ?></td>
    <td class="center"><?php echo $data['teacher_name']; ?></td>
    <td class="center">
        <a href="<?php echo $this->createUrl('class/update', array('ID' => $data['ID'])) ?>">详细</a>
    </td>
</tr>
