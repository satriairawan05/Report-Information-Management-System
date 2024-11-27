<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     *
     * Get access permission for a spesific page based on user group
     *
     * @param  string $pageName The name or identifier of the page.
     * @param  string $userGroup The user group of the current user.
     *
     * @return array Returns data in array format
     *
     */
    public function get_access(string $pageName, string $userGroup)
    {
        return \App\Models\User::select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->leftJoin('group_pages', 'users.role_id', '=', 'group_pages.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('pages.page_name', '=', $pageName)
            ->where('group_pages.group_id', '=', $userGroup)
            ->get();
    }

    /**
     * check the file from storage when extension is allowed
     *
     * @param  string $file is file in resources
     * @param  array $extension is allowed extension for check before download
     *
     * return redirect back when failed access
     */
    public function checkFiles(string $filePath, array $extension)
    {
        // Get the file extension from the path
        $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Log if extension is not allowed
        if (!in_array($fileExtension, $extension)) {
            \Illuminate\Support\Facades\Log::error("File type '.{$fileExtension}' not allowed for download.");
            return false;
        }

        // Check if the file exists in storage
        if (!\Illuminate\Support\Facades\Storage::exists($filePath)) {
            \Illuminate\Support\Facades\Log::error("File not found in storage: {$filePath}");
            return false;
        }

        // Log the successful match
        \Illuminate\Support\Facades\Log::info("File is valid and ready for download. Extension: '.{$fileExtension}'");
        return true;
    }

    /**
     *
     * Get access permission for a spesific page based on user group
     *
     * @param  string $userGroup The user group of the current user.
     *
     * @return array Returns data in array format
     *
     */
    public static function get_sidebar_access(string $userGroup)
    {
        return \App\Models\User::leftJoin('group_pages', 'users.role_id', '=', 'group_pages.group_id')
            ->leftJoin('groups', 'users.role_id', '=', 'groups.group_id')
            ->leftJoin('pages', 'group_pages.page_id', '=', 'pages.page_id')
            ->where('group_pages.access', '=', 1)
            ->where('group_pages.group_id', '=', $userGroup)
            ->select(['group_pages.access', 'pages.page_name', 'pages.action'])
            ->get();
    }
}
