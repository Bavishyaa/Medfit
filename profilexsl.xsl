<xsl:stylesheet version='1.0' xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
    
    <html lang="en">
        <head>
            <link rel='stylesheet' type='text/css' href='profilestyle.css'/>
            <title>Profile</title>
        </head>
        <body>
            <button onclick="window.location.href='dummy.php'" style="width: 200px; height: 70px; border: none; border-radius: 100px; font-size: 120%; background-color: white; color: blue; ">Back</button>

            <h1>PROFILE</h1>

            <div>
                <xsl:for-each select="PAGE/PROFILE">
                    <h4><xsl:value-of select="ID"/></h4>
                    <h4><xsl:value-of select="FNAME"/></h4>
                    <h4><xsl:value-of select="LNAME"/></h4>
                    <h4><xsl:value-of select="AGE"/></h4>
                    <h4><xsl:value-of select="GENDER"/></h4>
                    <h4><xsl:value-of select="BLOODTYPE"/></h4>
                    <h4><xsl:value-of select="PHONE"/></h4>
                    <h4><xsl:value-of select="EMAIL"/></h4>
                </xsl:for-each>
            </div>
        </body>
    </html>

</xsl:template>
</xsl:stylesheet>