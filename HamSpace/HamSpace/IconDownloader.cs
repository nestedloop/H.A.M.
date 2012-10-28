using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Net;
using System.Threading;
using System.Drawing;
using System.IO;

namespace HamSpace
{
    public static class IconDownloader
    {
        private static WebClient webClient;
        private static Thread workerThread;
        private static bool working;

        private static volatile Queue<string> downloadQueue;
        private static volatile Queue<string> imageKeyQueue;

        private static string leftUrl = "http://i.imgur.com/";
        private static string rightUrl = "s.png";

        public static int Counter = 2;

        public static void Init()
        {
            downloadQueue = new Queue<string>();
            imageKeyQueue = new Queue<string>();
            webClient = new WebClient();
            //workerThread  = new Thread(new ThreadStart(Work));
            working = false;

        }

        public static void SetOwnAvatar(string url)
        {
            HttpWebRequest request;
            WebResponse response;

            if (url == "") return;

            url = leftUrl + url + rightUrl;
            request = (HttpWebRequest)WebRequest.Create(url);
            request.AllowAutoRedirect = false;

            response = request.GetResponse();

            Image image = new Bitmap(response.GetResponseStream());
            //FormsManager.MainForm.SetOwnAvatar(image);
        }

        public static void AddToQueue(string key, string url)
        {
            lock (downloadQueue) lock (imageKeyQueue)
                {
                    downloadQueue.Enqueue(url);
                    imageKeyQueue.Enqueue(key);
                }

            if (!working)
            {
                working = true;
                workerThread = new Thread(new ThreadStart(Work));
                workerThread.Start();
            }
        }

        private static void Work()
        {
            while (downloadQueue.Count > 0)
                DownloadNewItem();
            working = false;
            MainForm.Instance.ListInvokeInvalidate();
        }

        private static void DownloadNewItem()
        {
            string imageUrl;
            string imageKey;
            lock (downloadQueue) lock (imageKeyQueue) //trebuie si aici lock? nu cred
                {
                    imageUrl = downloadQueue.Dequeue();
                    imageKey = imageKeyQueue.Dequeue();

                    imageUrl +=imageUrl.Remove(imageUrl.Length - 4, 4);
                    imageUrl += "s.jpg";
                }

            HttpWebRequest request;
            WebResponse response;

            request = (HttpWebRequest)WebRequest.Create(imageUrl);
            request.AllowAutoRedirect = false;

            try
            {
                response = request.GetResponse();
                Image image = new Bitmap(response.GetResponseStream());
                MainForm.Instance.ListInvokeAddImage(imageKey, image);
            }
            catch
            { }
        }
    }
}
