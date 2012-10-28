using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using System.Net;
using System.Xml;
using System.IO;

namespace HamSpace
{
    public partial class MainForm : Form
    {
        public static MainForm Instance { get; set; }
        public MainForm()
        {
            InitializeComponent();
            IconDownloader.Init();
            Instance = this;
        }

        private void loadButton_Click(object sender, EventArgs e)
        {
            string mihaiUrl = "http://10.10.2.102/export/";
            HttpWebRequest request;
            WebResponse response;

            request = (HttpWebRequest)WebRequest.Create(mihaiUrl);
            request.AllowAutoRedirect = false;

            try
            {
                response = request.GetResponse();
                XmlDocument xmlDoc = new XmlDocument();
                // MemoryStream ms = new MemoryStream(response.GetResponseStream());
                xmlDoc.Load(response.GetResponseStream());
                XmlNodeList appList = xmlDoc.GetElementsByTagName("app");
                foreach (XmlNode node in appList)
                {
                    AppContainer appCont = new AppContainer();
                    foreach (XmlNode child in node.ChildNodes)
                    {
                        switch (child.Name)
                        {
                            case "id":
                                appCont.appId = child.InnerText;
                                break;
                            case "name":
                                appCont.name = child.InnerText;
                                break;
                            case "short-desc":
                                appCont.descShort = child.InnerText;
                                break;
                            case "long-desc":
                                appCont.descLong = child.InnerText;
                                break;
                            case "category":
                                appCont.category = child.InnerText;
                                break;
                            case "keywords":
                                appCont.keywords = child.InnerText;
                                break;
                            case "icon":
                                appCont.icon = child.InnerText;
                                break;
                            case "version":
                                appCont.verison = child.InnerText;
                                break;
                            case "link":
                                appCont.link = child.InnerText;
                                break;
                        }
                    }

                    IconDownloader.AddToQueue(appCont.appId, appCont.icon);
                    ListInvokeAddItem(appCont);
                }
            }
            catch
            { }
        }

        public void ListInvokeInvalidate()
        {
            installAppslistView.Invoke(new MethodInvoker( () => installAppslistView.Invalidate() ));
        }

        public void ListInvokeAddImage(string imageKey, Image image)
        {
            installAppslistView.Invoke(new MethodInvoker(() => ListAddImage(imageKey, image)));
        }

        public void ListInvokeAddItem(AppContainer appCont)
        {
            installAppslistView.Invoke(new MethodInvoker( () => ListAddItem(appCont) ) );
        }

        public void ListAddImage(string imageKey, Image image)
        {
            imageList.Images.Add(imageKey, image);
        }

        private void ListAddItem(AppContainer appCont)
        {
            ListViewItem appItem = new ListViewItem(appCont.name);
            appItem.SubItems.Add(appCont.descShort);
            appItem.ImageKey = appCont.appId;

            installAppslistView.Items.Add(appItem);
        }
    }
}
