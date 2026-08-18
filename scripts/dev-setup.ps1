<#
    .SYNOPSIS
    翻訳開発環境をセットアップする

    .DESCRIPTION
    pterodactyl/panel の upstream をクローンし、
    Git管理の翻訳ファイルで上書きする。
    VS Code で panel/ja/.dev/ を開けば補完・型チェック・リントが動く。

    .EXAMPLE
    pwsh scripts/dev-setup.ps1
#>

param(
    [string]$PanelVersion = "v1.15.1"
)

$ErrorActionPreference = "Stop"

$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$ProjectRoot = Split-Path -Parent $ScriptDir
$DevDir = Join-Path $ProjectRoot "panel\ja\.dev"
$ResourcesDir = Join-Path $ProjectRoot "panel\ja\resources"

Write-Host "==> pterodactyl/panel $PanelVersion をクローン" -ForegroundColor Cyan
if (Test-Path $DevDir) {
    Remove-Item -Recurse -Force $DevDir
}
git clone --depth 1 --branch $PanelVersion https://github.com/pterodactyl/panel.git $DevDir 2>&1 | Out-Null
Remove-Item -Recurse -Force (Join-Path $DevDir ".git")

Write-Host "==> 翻訳ファイルをコピー" -ForegroundColor Cyan
# Git管理の翻訳ファイルで upstream の同名ファイルを上書き
Get-ChildItem -Path $ResourcesDir -Recurse -File | ForEach-Object {
    $relative = $_.FullName.Substring($ResourcesDir.Length + 1)
    $target = Join-Path $DevDir "resources\$relative"
    $targetDir = Split-Path -Parent $target
    if (-not (Test-Path $targetDir)) {
        New-Item -ItemType Directory -Path $targetDir -Force | Out-Null
    }
    Copy-Item -Path $_.FullName -Destination $target -Force
}

Write-Host "==> 依存関係をインストール (npm)" -ForegroundColor Cyan
Push-Location $DevDir
npm install 2>&1 | Out-Null
Pop-Location

Write-Host ""
Write-Host "==> セットアップ完了" -ForegroundColor Green
Write-Host ""
Write-Host "    開発ディレクトリ:  $DevDir"
Write-Host ""
Write-Host "    VS Code で開く:"
Write-Host "      code $DevDir"
Write-Host ""
Write-Host "    型チェック:        npx tsc --noEmit"
Write-Host "    リント:            npx eslint resources/scripts/**/*.{ts,tsx}"
Write-Host "    本番ビルド:        npx cross-env NODE_ENV=production node_modules/.bin/webpack --mode production"
Write-Host ""
Write-Host "    ※ 翻訳ファイルはコピーなので、.dev/ 側での編集は"
Write-Host "      panel/ja/resources/ に手動で反映してください"
Write-Host "    ※ 本番ビルドはDockerビルドで行うため、ローカルでは不要です"
Write-Host "    ※ npm を使用します（upstream は yarn ですが開発用途なら npm で問題ありません）"
