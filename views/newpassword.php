<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   newpassword.php                                    :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: ptuukkan <ptuukkan@student.hive.fi>        +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/11/18 14:50:32 by ptuukkan          #+#    #+#             */
/*   Updated: 2020/11/18 14:50:32 by ptuukkan         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */
?>


<div class="ui grid">
<form class="ui form six wide column centered <?= (isset($params["errors"])) ? "error" : "" ?>" method="post">
  <div class="field required">
    <label>Password</label>
    <input
      type="password"
      name="password"
      id="password"
      placeholder="Password"
	  required
      value=<?= (isset($params["values"]["password"])) ? $params["values"]["password"] : "" ?>
    >
    <?= self::_printFieldErrors("password", $params) ?>
  </div>
  <div class="field required">
    <label>Confirm password</label>
    <input
      type="password"
      name="password_confirm"
      id="password_confirm"
      placeholder="Confirm Password"
	  required
      value=<?= (isset($params["values"]["password_confirm"])) ? $params["values"]["password_confirm"] : "" ?>
    >
    <?= self::_printFieldErrors("password_confirm", $params) ?>
  </div>
  <?= self::_printFieldErrors("global", $params) ?>
  <button class="ui button primary" type="submit">Submit</button>
  <button class="ui button" type="button" onclick="window.location.href='/'">Cancel</button>
</form>
</div>

