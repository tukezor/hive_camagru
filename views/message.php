<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   message.php                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: ptuukkan <ptuukkan@student.hive.fi>        +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/10/25 17:25:22 by ptuukkan          #+#    #+#             */
/*   Updated: 2020/10/25 17:25:22 by ptuukkan         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */
?>

<div class="ui <?= $message["status"] ?> message">
  <div class="header">
    <?= $message["header"] ?>
  </div>
  	<p><?= $message["body"] ?></p>
</div>
