<#
    .SYNOPSIS
    .dev/ で編集した翻訳ファイルを Git管理側に同期する

    .DESCRIPTION
    dev-setup.ps1 で構築した .dev/resources/ の内容を
    panel/ja/resources/ にコピーする。
    編集後、ビルド前に実行すること。

    .EXAMPLE
    pwsh scripts/dev-sync.ps1
#>

$ErrorActionPreference = "Stop"

$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$ProjectRoot = Split-Path -Parent $ScriptDir
$DevResources = Join-Path $ProjectRoot "panel\ja\.dev\resources"
$GitResources = Join-Path $ProjectRoot "panel\ja\resources"

if (-not (Test-Path $DevResources)) {
    Write-Error ".dev/ が存在しません。先に pwsh scripts/dev-setup.ps1 を実行してください"
    exit 1
}

# .dev/resources/ にあって panel/ja/resources/ と内容が異なるファイルを同期
$synced = 0
Get-ChildItem -Path $GitResources -Recurse -File | ForEach-Object {
    $relative = $_.FullName.Substring($GitResources.Length + 1)
    $devFile = Join-Path $DevResources $relative

    if (Test-Path $devFile) {
        $gitHash = (Get-FileHash $_.FullName).Hash
        $devHash = (Get-FileHash $devFile).Hash

        if ($gitHash -ne $devHash) {
            Copy-Item -Path $devFile -Destination $_.FullName -Force
            Write-Host "  更新: $relative" -ForegroundColor Yellow
            $synced++
        }
    }
}

if ($synced -eq 0) {
    Write-Host "変更なし" -ForegroundColor Green
} else {
    Write-Host ""
    Write-Host "$synced ファイルを同期しました" -ForegroundColor Green
    Write-Host "git diff で確認後、コミットしてください" -ForegroundColor Cyan
}
