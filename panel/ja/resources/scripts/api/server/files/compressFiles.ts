import { FileObject } from '@/api/server/files/loadDirectory';
import http from '@/api/http';
import { rawDataToFileObject } from '@/api/transformers';

export default async (uuid: string, directory: string, files: string[]): Promise<FileObject> => {
    const { data } = await http.post(
        `/api/client/servers/${uuid}/files/compress`,
        { root: directory, files },
        {
            timeout: 60000,
            timeoutErrorMessage:
                'アーカイブの生成に時間がかかっているようです。完了後に表示されます。',
        }
    );

    return rawDataToFileObject(data);
};
