<?php

function user_has_access($user_id): bool
{
	// Check if the user has the required role and permissions
	// Example: fetch user's role and permissions from database
	$user_role = get_user_role($user_id);
	$user_permissions = get_user_permissions($user_id);

	// Check if the user's role has access to the requested route or controller/method
	if ($user_role == 'admin') {
		return true; // Admin has access to all routes
	} elseif (in_array('manage_users', $user_permissions)) {
		return true; // User has permission to manage users
	}

	return false; // User doesn't have access
}

function get_user_role($user_id) {
	// Load the database library if not already loaded
	$CI =& get_instance();
	$CI->load->database();

	// Fetch user's role from the database
	$CI->db->select('*');
	$CI->db->from('user_role');
	$CI->db->where('user_id', $user_id);
	$query = $CI->db->get();

	// Extract role from the query result
	$row = $query->row();
	if ($row) {
		return $row->role_name;
	}

	return null;
}


function get_user_permissions($user_id): array
{
	// Load the database library if not already loaded
	$CI =& get_instance();
	$CI->load->database();

	// Fetch user's permissions from the database
	$CI->db->select('*');
	$CI->db->from('user_permission');
	$CI->db->join('user_role', 'user_role.user_id = ' . $user_id);
	$CI->db->where('user_permission.user_id', $user_id);
	$query = $CI->db->get();

	// Extract permissions from the query result
	$permissions = array();
	foreach ($query->result() as $row) {
		$permissions[] = $row->permission_key;
	}

	return $permissions;
}
