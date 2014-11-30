<tr>
    <td class="center"><?php echo $data['class_code']; ?></td>
    <td class="center"><?php echo $data['class_name']; ?></td>
    <td class="center"><?php echo isset($grade[$data['grade']]) ? $grade[$data['grade']] : ''; ?></td>
    <td class="center"><?php echo $data['entry_year']; ?></td>
    <td class="center"><?php echo TClasses::model()->getTermTypeDisplayName($data['term_type']);?></td>
    <td class="center"><?php echo TClasses::model()->getClassTypeDisplayName($data['class_type']); ?></td>
    <td class="center"><?php echo $data['specialty_name']; ?></td>
    <td class="center"><?php echo $data['teacher_name']; ?></td>
    <td class="center">
        <span class="label <?php echo $data['status'] === '1' ? 'label-active' : 'label-stop';?>">
            <?php echo TClasses::model()->getClassStatusDisplayName($data['status']); ?>
        </span>
    </td>
    <td class="center">
        <?php if(in_array('class/update', $this->authoritys)) { ?>
            <a href="<?php echo $this->createUrl('class/update',  array('ID' => $data['ID'])) ?>">详细</a> &nbsp;&nbsp;&nbsp;
        <?php } ?>
        
        <?php if(in_array('class/student', $this->authoritys)) { ?>
            <a href="<?php echo $this->createUrl('class/student', array('ID' => $data['ID'])) ?>">学生一览</a>
        <?php } ?>
    </td>
</tr>
