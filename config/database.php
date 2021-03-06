<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   database.php                                       :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: ptuukkan <ptuukkan@student.hive.fi>        +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/10/05 18:22:38 by ptuukkan          #+#    #+#             */
/*   Updated: 2020/10/05 18:22:38 by ptuukkan         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

$DB_DBNAME = "camagru";
$DB_DSN = "mysql:host=localhost;dbname=$DB_DBNAME;charset=utf8";
$DB_USER = "root";
$DB_PASSWORD = "password";
$DB_OPTIONS = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

?>
