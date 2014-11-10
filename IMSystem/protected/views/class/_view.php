<tr>
    <td class="center"><?php echo $data['class_code']; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php echo isset($grade[$data['grade']]) ? $grade[$data['grade']] : ''; ?></td>
    <td class="center"><?php echo $data['entry_year']; ?></td>
    <td class="center"><?php echo ClassForm::getTermTypeDisplayName($data['term_type']);?></td>
    <td class="center"><?php if($data['class_type'] ==='0') echo '普通高中' ; if($data['class_type'] ==='1') echo '技能专业' ;  ?></td>
    <td class="center"><?php echo $data['specialty_name']; ?></td>
    <td class="center"><?php echo $data['teacher_name']; ?></td>
    <td class="center">
        <span class="label <?php echo $data['status'] === '1' ? 'label-active' : 'label-stop';?>"><?php echo $data['status'] === '1' ? '正常' : '暂停'; ?></span>
    </td>
    <td class="center">
        <a href="<?php echo $this->createUrl('class/update',  array('ID' => $data['ID'])) ?>">详细</a> &nbsp;&nbsp;&nbsp;
        <a href="<?php echo $this->createUrl('class/student', array('ID' => $data['ID'])) ?>">学生一览</a>
    </td>
</tr>
