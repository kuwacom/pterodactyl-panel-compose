import http from '@/api/http';

export default async (uuid: string, directory: string, file: string): Promise<void> => {
    await http.post(
        `/api/client/servers/${uuid}/files/decompress`,
        { root: directory, file },
        {
            timeout: 300000,
            timeoutErrorMessage:
                'アーカイブの展開に時間がかかっているようです。完了後に展開されたファイルが表示されます。',
        }
    );
};
