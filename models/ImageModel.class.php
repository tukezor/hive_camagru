<?php
/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ImageModel.class.php                               :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: ptuukkan <ptuukkan@student.hive.fi>        +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2020/11/01 16:46:29 by ptuukkan          #+#    #+#             */
/*   Updated: 2020/11/01 16:46:29 by ptuukkan         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

require_once "BaseModel.class.php";
require_once "UserModel.class.php";
require_once "CommentModel.class.php";

class ImageModel extends BaseModel
{
	protected $id;
	protected $user_id;
	protected $img_path;
	protected $img_date;
	private $_imgData;
	public $comments;
	public $user;
	private $_likes;
	private $_liked = false;
	private $_owner = false;

	public function __construct($params = [])
	{
		if (!empty($params)) {
			$this->user_id = Application::$app->session->userId;
			$this->_imgData = $params["img_data"];
			$this->img_date = time();
		}
		$this->user = UserModel::findOne(["id" => $this->user_id]);
		$this->_likes = count(LikeModel::findMany([], ["img_id" => $this->id]));
		$this->comments = CommentModel::findMany([], ["img_id" => $this->id]);
		$this->_sortComments();
		if (Application::$app->session->loggedIn) {
			if (Application::$app->session->userId === $this->user_id) {
				$this->_owner = true;
			}
			if (LikeModel::findOne(["img_id" => $this->id, "user_id" => $this->user_id])) {
				$this->_liked = true;
			}
		}

	}

	public function getId() { return $this->id; }

	public function getUserId() { return $this->UserId; }

	public function getImgPath() { return $this->img_path; }

	public function getDate() { return $this->img_date; }

	public function getLikes() { return $this->_likes; }

	public function isOwner() { return $this->_owner; }

	public function isLiked() { return $this->_liked; }

	protected function _tableName() {  return "images"; }

	protected function _propertiesInDb()
	{
		return ["user_id", "img_path", "img_date"];
	}

	public function validate()
	{
		$parts = explode(',', $this->_imgData);
		if (count($parts) !== 2) {
			return false;
		}
		if (!preg_match('%^[a-zA-Z0-9/+]*={0,2}$%', $parts[1])) {
			return false;
		}
		$imgType = str_replace(
			['data:image/', ';', 'base64'],
			['', '', '',],
			$parts[0]
		);
		$allowedTypes = ['png', 'jpg', 'jpeg'];
		if (!in_array($imgType, $allowedTypes)) {
			return false;
		}
		$this->img_path = "public/img/uploads/" . uniqid("img_") . "." . $imgType;
		$this->_imgData = $parts[1];
		return true;
	}

	public function save()
	{
		parent::save();
		if (!@file_put_contents($this->img_path, base64_decode($this->_imgData))) {
			$this->remove();
			throw new HttpException("Cannot save image", 500, true);
		}
	}

	public function remove()
	{
		if (file_exists($this->img_path)) {
			unlink($this->img_path);
		}
		parent::remove();
	}

	private function _sortComments()
	{
		if (count($this->comments) > 1) {
			usort($this->comments, function($first, $second) {
				return $first->getDate() < $second->getDate();
			});
		}
	}
}
